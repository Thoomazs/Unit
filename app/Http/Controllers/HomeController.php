<?php namespace App\Http\Controllers;

use App\Models\ProductRepository;
use App\Support\Controller as BaseCOntroller;

class HomeController extends BaseCOntroller
{

    function __construct()
    {
        parent::__construct();
    }


    /**
     * Show Homepage
     *
     * @return Response
     */
    public function index()
    {
        return view( 'site.homepage' );
    }

    public function help()
    {
        return view( 'site.help' );
    }

}
