<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{


    /**
     * Show Homepage
     *
     * @return Response
     */
    public function getHomepage()
    {
        return view( 'admin.homepage' );
    }

}
