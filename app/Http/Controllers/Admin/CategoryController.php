<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Requests\Request;
use App\Models\Category;
use App\Models\CategoryRepository;

class CategoryController extends Controller
{

    protected $repo;

    function __construct( CategoryRepository $categoryRepository )
    {
        $this->repo = $categoryRepository;
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

        $categories = $this->repo->paginate();

        return view( 'admin.categories.index', compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = \FormBuilder::create( 'App\Forms\Admin\CategoryForm', [ 'method' => 'POST', 'url' => route( 'admin.categories.store' ) ] );

        return view( 'admin.categories.create', compact( 'form' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( CategoryRequest $request )
    {
        $category = $this->repo->create( $request->all() );

        flash()->success( trans( 'Category was created' ) );

        return redirect()->route( "admin.categories.edit", [ $category->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Category $category )
    {
        return redirect()->route( 'admin.categories.edit', [ $category->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Category $category )
    {
        if ( is_null( $category ) ) return redirect()->route( 'admin.categories.index' );

        $form = \FormBuilder::create( 'App\Forms\Admin\CategoryForm', [ 'method' => 'POST',
                                                                        'url'    => route( 'admin.categories.update', [ $category->id ] ),
                                                                        'model'  => $category ] );

        return view( 'admin.categories.edit', compact( 'category', 'form' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( CategoryRequest $request )
    {
        $category = $this->repo->update( $request->all() );

        flash()->success( trans( 'Category was updated' ) );

        return redirect()->route( "admin.categories.edit", [ $category->id ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Category $category )
    {
        if ( is_null( $category ) ) return redirect()->route( 'admin.categories.index' );

        $this->repo->delete( $category->id );

        flash()->error( trans( 'common.Category #'.$category->id.' '.$category->name.' was deleted.' ) );

        return redirect()->route( "admin.categories.index" );
    }

}
