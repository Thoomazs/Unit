<?php namespace App\Support;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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
}
