<?php namespace App\Http\Controllers\Shop;

use App\Http\Requests\Cart\DeliveryInformationRequest;
use App\Http\Requests\Cart\ShippingAndPaymentRequest;
use App\Http\Requests\Request;
use App\Models\Shop\OrdersRepository;
use App\Models\Shop\Status;
use App\Models\UsersRepository;
use App\Services\OrderService;
use App\Support\Controller;
use Illuminate\Support\Collection;


/**
 * Class CartController
 *
 * @package App\Http\Controllers\Shop
 */
class CartController extends Controller
{

    /**
     * @param OrderService $orderService
     */
    function __construct( OrderService $orderService )
    {
        parent::__construct();

        $this->service = $orderService;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getCart()
    {
        // find users active order, or show empty cart
        $order = $this->_getOrder();

        // cart view
        return view( 'site.cart.cart', compact( 'order' ) );
    }

    /**
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postAdd( Request $request )
    {
        // add item to cart
        $response   = $this->service->addItem( $this->user, $request->data('product_id', 'quantity') );

        // return back with errors
        if ( $response !== true )
        {
            flash()->error( $response );

            return redirect()->back()->withErrors( $response );
        }

        // ok
        flash()->success( trans( 'common.Product added to cart' ) );

        return redirect()->route( 'cart.show' );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdate( Request $request )
    {
        // update quantity of item on cart
        $response = $this->service->updateItem( $this->user, $request->data( 'product_id', 'quantity' ) );

        // if update product to order is OK -> show flash info
        if ( $response !== true )
        {
            flash()->error( trans( $response ) );
        }
        else
        {
            flash()->success( trans( 'common.Product quantity change' ) );
        }

        return redirect()->route( 'cart.show' );
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDelete( Request $request )
    {
        // remove item from cart
        $this->service->deleteItem( $this->user, $request->get( 'product_id' ) );

        flash()->success( trans( 'common.Product removed' ) );

        return redirect()->route( 'cart.show' );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getDeliveryInformation()
    {
        // find users active order, or show empty cart
        $order = $this->_getOrder();

        // return to cart
        if ( is_null( $order ) ) return redirect()->route( "cart.show" );

        // no address in order -> use users address
        if ( ! $order->shipping_address_id )
        {
            $user                       = $this->service->getUserRepo()->find( $this->user );
            $order->shipping_address_id = $user->address_id;
        }

        return view( 'site.cart.delivery-information', compact( 'order' ) );
    }

    /**
     * @param DeliveryInformationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDeliveryInformation( DeliveryInformationRequest $request )
    {
        // save way how to change only users order and no other
        $data = $this->_addOrderId( $request->data() );

        // update delivery information
        $this->service->getOrderRepo()->update( $data->toArray() );

        return redirect()->route( 'cart.shipping-and-payment' );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getShippingAndPayment()
    {
        // find users active order, or show empty cart
        $order = $this->_getOrder();

        // return to cart
        if ( is_null( $order ) ) return redirect()->route( "cart.show" );

        // get all payments and sehippings
        $payments  = $this->service->payments();
        $shippings = $this->service->shippings();

        return view( 'site.cart.shipping-and-payment', compact( 'order', 'payments', 'shippings' ) );
    }

    /**
     * @param ShippingAndPaymentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postShippingAndPayment( ShippingAndPaymentRequest $request )
    {
        // save way how to change only users order and no other
        $data = $request->all();

        $data[ 'id' ] =

            // update payment and shipping
            $this->service->getOrderRepo()->update( $data );

        return redirect()->route( 'cart.summary' );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getSummary()
    {
        // find users active order, or show empty cart
        $order = $this->_getOrder();

        if ( is_null( $order ) ) return redirect()->route( "cart.show" );

        return view( 'site.cart.summary', compact( 'order' ) );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSummary()
    {
        // find users active order, or show empty cart
        $order = $this->_getOrder();

        $this->service->changeStatus( $order, Status::NEW_ORDER );

        $this->service->sendEmail( $order );

        return redirect()->route( 'cart.thank-you' );
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getThankyou()
    {

        return view( 'site.cart.thank-you' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private function _getOrder()
    {
        return $order = $this->service->repo->hasActiveOrder( $this->user );
    }

    /**
     * @param Collection $data
     *
     * @return Collection
     */
    private function _addOrderId( Collection $data )
    {
        $order = $this->_getOrder();
        $data->put( 'id', $order->id );

        return $data;
    }

}
