<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Models\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    function __construct( ProductRepository $productRepository )
    {
        $this->repo = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index( Request $request )
    {
        $s = $request->get( 's' );

        if ( $s ) $this->repo->search( $s );

        $products = $this->repo->paginate();

        if ( $s and count( $products ) == 1 ) return redirect()->route( "admin.products.edit", [ $products->first()->id ] );

        return view( 'admin.products.index', compact( 'products' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = \FormBuilder::create( 'App\Forms\Admin\ProductForm', [ 'method' => 'POST', 'url' => route( 'admin.products.store' ) ] );

        return view( 'admin.products.create', compact( 'form' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( ProductRequest $request )
    {
        $product = $this->repo->create( $request->all() );

        flash()->success( trans( 'Product was created' ) );

        return redirect()->route( "admin.products.edit", [ $product->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Product $product )
    {
        return redirect()->route( 'admin.products.edit', [ $product->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Product $product )
    {
        if ( is_null( $product ) ) return redirect()->route( 'admin.products.index' );

        $form = \FormBuilder::create( 'App\Forms\Admin\ProductForm', [ 'method' => 'PATCH', 'url' => route( 'admin.products.update', [ $product->id ] ), 'model' => $product ] );

        return view( 'admin.products.edit', compact( 'product', 'form' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( ProductRequest $request )
    {
        $product = $this->repo->update( $request->all() );

        flash()->success( trans( 'common.Product was updated' ) );

        return redirect()->route( "admin.products.edit", [ $product->id ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Product $product )
    {
        if ( is_null( $product ) ) return redirect()->route( 'admin.products.index' );

        $this->repo->delete( $product->id );

        flash()->error( trans( 'common.Product #'.$product->id.' '.$product->name.' was deleted.' ) );

        return redirect()->route( "admin.products.index" );
    }

}
