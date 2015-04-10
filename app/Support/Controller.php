<?php namespace App\Support;

use App\Models\Shop\OrderRepository;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

abstract class Controller extends BaseController
{

    use DispatchesCommands, ValidatesRequests;

    /**
     * @var Controller repository
     */
    protected $repo;

    /**
     * @var User instance
     */
    protected $user;


    function __construct()
    {
        $this->user = $this->_setUser();

        $this->_setCart();
    }

    /**
     * Return current user id
     */
    private function _setUser()
    {
        if ( Auth::check() ) return Auth::user()->id;

        if ( Cookie::has( "tempUser" ) ) return Cookie::get( "tempUser" );

        return null;
    }

    /**
     * Set cart data to view
     */
    private function _setCart()
    {
        View::share( 'cart', OrderRepository::get( $this->user ) );
    }

}
