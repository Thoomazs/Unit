<?php namespace App\Http\Controllers\Retrospective;

use App\Models\ProductRepository;
use App\Support\Controller as BaseController;

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

        return view( 'site.retrospective.index' );
    }

}
