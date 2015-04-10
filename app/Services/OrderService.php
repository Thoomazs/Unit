<?php namespace App\Services;

use App\Models\ProductRepository;
use App\Models\Shop\CartRepository;
use App\Models\Shop\Order;
use App\Models\Shop\OrderRepository;
use App\Models\Shop\Payment;
use App\Models\Shop\Shipping;
use App\Models\UserRepository;
use App\Support\Collection;
use App\Support\Service;

/**
 * Class OrderService
 *
 * @package App\Http\Services
 */
class OrderService
{
    /**
     * @var OrderRepository
     */
    public $repo;

    /**
     * @var CartRepository
     */
    protected $cartRepo;

    /**
     * @var UserRepository
     */
    protected $userRepo;

    /**
     * @var ProductRepository
     */
    protected $productRepo;

    /**
     * @param OrderRepository   $orderRepository
     * @param UserRepository    $userRepository
     * @param CartRepository    $cartRepository
     * @param ProductRepository $productRepository
     */
    function __construct( OrderRepository $orderRepository, UserRepository $userRepository, CartRepository $cartRepository, ProductRepository $productRepository )
    {
        $this->repo        = $orderRepository;
        $this->cartRepo    = $cartRepository;
        $this->userRepo    = $userRepository;
        $this->productRepo = $productRepository;
    }

    /**
     * If user not logged in or not has temporary user account -> created one
     *
     * @param $user_id
     *
     * @return mixed
     */
    private function getUserId( $user_id )
    {
        return ( $user_id ) ?: $this->userRepo->createTemporaryUser()->id;
    }

    /**
     * Test if user has this product in shopping cart
     *
     * @param Order $order
     * @param       $product_id
     *
     * @return bool
     */
    public function hasItem( Order $order, $product_id )
    {
        return $order->items->keyBy( 'product_id' )->has( $product_id );
    }

    /**
     * Try to add item to shopping cart
     *
     * @param            $user_id
     * @param Collection $item
     *
     * @return bool|string
     */
    public function addItem( $user_id, Collection $item )
    {
        // Find product by its ID from form data
        $product = $this->productRepo->find( $item->product_id );

        // if its not a product -> redirect back
        if ( is_null( $product ) ) return 'No product found';

        // if not enough items stock
        if ( ! $this->productRepo->reduceStock( $product->id, $item->quantity ) ) return 'Not enough items in stock';

        // get user id
        $user_id = $this->getUserId( $user_id );

        // get users active order
        $order = $this->repo->getActiveOrder( $user_id );

        // set order and price to item
        $item->order_id = $order->id;
        $item->price    = $product->price;

        // if order has this item -> add items to it, else create new item
        $item = $this->addItemToOrder( $order, $item->toArray() );

        // Logger
        \Event::fire( 'cart.add', $item );

        return (bool)$item;
    }

    /**
     * Add item to shopping cart
     *
     * @param Order $order
     * @param array $item
     *
     * @return \App\Support\Model|null
     */
    public function addItemToOrder( Order $order, array $item )
    {
        return ( $this->hasItem( $order, $item[ 'product_id' ] ) ) ? $this->cartRepo->add( $item ) : $this->cartRepo->create( $item );
    }

    /**
     * Update items quantity
     *
     * @param            $user_id
     * @param Collection $data
     *
     * @return bool|string
     */
    public function updateItem( $user_id, Collection $data )
    {
        // Find product by its ID from form data
        $product = $this->productRepo->find( $data[ "product_id" ] );

        // if its not a product -> redirect back
        if ( is_null( $product ) ) return 'No product found.';

        // get users active order
        $order = $this->repo->hasActiveOrder( $user_id );

        // if dont have order -> redirect back
        if ( is_null( $order ) ) return 'No order found.';

        // find item
        $item = $this->cartRepo->findItem( $order->id, $product->id );

        // if dont have item in order -> redirect back
        if ( is_null( $item ) ) return 'No item found.';

        // if somehow they manage to input zero quantity -> delete item
        if ( $data->quantity == 0 ) return $this->removeItem( $user_id, $item->id );

        // change in items quantity
        $diff = $data->quantity - $item->quantity;

        // no change
        if ( $diff == 0 )
        {
            return true;
        }

        // increase number
        elseif ( $diff > 0 )
        {
            if ( ! $this->productRepo->reduceStock( $product->id, $diff ) ) return 'Not enough items in stock.';
        }

        // decrease number
        else if ( $diff < 0 )
        {
            $this->productRepo->increaseStock( $product->id, -1 * $diff );
        }

        // set item id
        $data->id = $item->id;

        // update item
        $item = $this->cartRepo->update( $data->toArray() );

        // Logger
        \Event::fire( 'cart.update', $item, $diff );

        // return true if its not null
        return ( ! is_null( $item ) );
    }

    /**
     * Delete item from shopping cart
     *
     * @param $user_id
     * @param $type_id
     *
     * @return bool
     */
    public function deleteItem( $user_id, $type_id )
    {
        // get users active order
        $order = $this->repo->hasActiveOrder( $user_id );

        // no order
        if ( ! $order ) return false;

        // find item by its id
        $item = $this->cartRepo->findItem( $order->id, $type_id );

        // no item in order
        if ( ! $item ) return false;

        // if not enough items stock
        if ( ! $this->productRepo->increaseStock( $type_id, $item->quantity ) ) return false;

        // delete item
        $this->cartRepo->delete( $item->id );

        // Logger
        \Event::fire( 'cart.delete', $item );

        return true;
    }

    /**
     * Transfer Cart from one user to another
     *
     * @param $user_id_from
     * @param $user_id_to
     */
    public function transferCart( $user_id_from, $user_id_to )
    {
        // get orders
        $order_from = $this->repo->hasActiveOrder( $user_id_from );
        $order_to   = $this->repo->getActiveOrder( $user_id_to );

        if ( is_null( $order_from ) ) return;

        // get items
        $carts = $this->cartRepo->setOrder( $order_from->id )->all();

        // cycle all items in order
        foreach ( $carts as $cart )
        {
            // just to be sure item has right attributes
            $item = [ 'id'         => $cart->id,
                      'product_id' => $cart->product_id,
                      'quantity'   => $cart->quantity,
                      'order_id'   => $order_to->id,
                      'price'      => $cart->price ];

            // add/create item to order
            $this->addItemToOrder( $order_to, $item );
        }

        // destroy order -> bc of FK destroy items
        $this->repo->delete( $order_from->id );
    }

    /**
     * Change status of order
     *
     * @param     $order
     * @param int $status
     */
    public function changeStatus( $order, $status = 1 )
    {
        $this->repo->update( [ 'id' => $order->id, 'status_id' => $status ] );
    }

    /**
     * Get Payments types
     *
     * @return Collection
     */
    public function payments()
    {
        return Payment::all();
    }

    /**
     * Get Shippings types
     *
     * @return Collection
     */
    public function shippings()
    {
        return Shipping::all();
    }
}