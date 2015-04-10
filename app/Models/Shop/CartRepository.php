<?php namespace App\Models\Shop;

use App\Support\Collection;
use App\Support\Model;
use App\Support\Repository;
use Illuminate\Support\Facades\Log;

/**
 * Class CartRepository
 *
 * @package App\Http\Repositories
 */
class CartRepository extends Repository
{

    function __construct( Cart $cart )
    {
        $this->model = $cart;
    }

    /**
     * Add basic query
     *
     * @return $this
     */
    public function addBasicQuery()
    {
        $this->query = $this->getQuery()->with('product');

        return $this;
    }

    /**
     * Set order
     *
     * @param $id
     *
     * @return Cart
     */
    public function setOrder( $id )
    {
        $this->query = $this->getQuery()->where( "order_id", "=", $id );

        return $this;
    }

    /**
     * Add item to cart
     *
     * @param array $data
     *
     * @return Model|null
     */
    public function add( array $data )
    {
        // find model instance from DB
        $item = $this->findItem( $data['order_id'], $data['product_id'] );

        // if not exist -> return
        if ( is_null( $item ) ) return null;

        // add quantity
        $item->quantity += $data['quantity'];

        // save
        $item->save();

        // return updated model
        return $item;
    }

    /**
     * Find item
     *
     * @param $order_id
     * @param $productType_id
     *
     * @return Cart|null
     */
    public function findItem( $order_id, $productType_id )
    {
        return $this->model->whereProductId( $productType_id )->whereOrderId( $order_id )->first();
    }

}
