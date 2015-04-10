<?php namespace App\Models\Shop;

use App\Models\AddressRepository;
use App\Models\Shop\Order;
use App\Models\Shop\Status;
use App\Support\Collection;
use App\Support\Repository;

/**
 * Class orderRepository
 *
 * @package App\Http\Repositories
 */
class OrderRepository extends Repository
{

    protected $addressRepo;


    function __construct( Order $order, AddressRepository $addressRepository )
    {
        $this->model = $order;

        $this->addressRepo = $addressRepository;
    }

    public function addBasicQuery()
    {
        $this->query = $this->getQuery()->with( 'items' )->orderBy( "id", "DESC" );

        return $this;
    }


    public function fillData( Order $order, Collection $data )
    {
        $data->shipping_address_id = $this->addressRepo->getAddressId( $data );
//        $data->delivery_address_id  = ( $data->isEmpty( 'billing_address' ) ) ? null : $this->addressRepo->getAddressId( $data, "billing_" );

        $order->fill( $data->toArray() );

        $order->save();

        return $order;
    }


    public function findActive( $user_id )
    {
        return $this->model->whereUserId( $user_id )->whereStatusId( Status::ACTIVE )->first();
    }

    /**
     * Find users active order
     *
     * @param $user_id
     *
     * @return Order|null
     */
    public function hasActiveOrder( $user_id )
    {
        return $this->findActive( $user_id );
    }

    /**
     * Try find active order | or create a new one
     *
     * @param $user_id
     *
     * @return Order
     */
    public function getActiveOrder( $user_id )
    {
        return ( $this->hasActiveOrder( $user_id ) ) ?: $this->create( [ "user_id" => $user_id, "status_id" => Status::ACTIVE ] );
    }

    static function get( $user_id )
    {
        $order = Order::whereUserId( $user_id )->whereStatusId( Status::ACTIVE )->first();

        $cart = ( is_null( $order ) || is_null( $order->price ) || is_null( $order->count ) ) ? [ 'price' => 0, 'count' => 0 ] : [ 'price' => $order->price,
                                                                                                                                   'count' => $order->count ];
        return Collection::make( $cart );
    }


}