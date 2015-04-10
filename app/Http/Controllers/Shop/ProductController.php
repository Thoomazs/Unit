<?php namespace App\Http\Controllers\Shop;

use App\Events\ProductWasVisited;
use App\Models\Product;
use App\Models\ProductRepository;
use App\Support\Controller;

class ProductController extends Controller
{

    function __construct( ProductRepository $productsRepository )
    {
        parent::__construct();

        $this->repo = $productsRepository;
    }

    public function getIndex()
    {
        $products = $this->repo->all();

        return view( 'site.products.index', compact( 'products' ) );
    }

    public function getDetail( Product $product )
    {
        return view( 'site.products.show', compact( 'product' ) );
    }
}
