<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleRepository;
use Illuminate\Http\Request;


/**
 * Class rolesController
 */
class RoleController extends Controller
{

    /**
     * @param role $role
     */
    function __construct( RoleRepository $rolesRepository )
    {
        $this->repo = $rolesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->repo->paginate();

        return view( 'admin.roles.index', compact( 'roles' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $form = \FormBuilder::create( 'App\Forms\Admin\RoleForm', [ 'method' => 'POST', 'url' => route( 'admin.roles.store' ) ] );

        return view( 'admin.roles.create', compact( 'form' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( Request $request )
    {
        $role = $this->repo->create( $request->all() );

        if ( is_null( $role ) ) return redirect()->back();

        flash()->success( trans( 'common.Role #'.$role->id.' '.$role->name.' created.' ) );

        return redirect()->route( "admin.roles.edit", [ $role->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Role $role )
    {
        return redirect()->route( 'admin.roles.edit', [ $role->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Role $role )
    {
        if ( is_null( $role ) ) return redirect()->route( 'admin.roles.index' );

        $form = \FormBuilder::create( 'App\Forms\Admin\RoleForm', [ 'method' => 'POST', 'url' => route( 'admin.roles.update', $role->id ), 'model' => $role ] );

        return view( 'admin.roles.edit', compact( 'role', 'form' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( Request $request )
    {
        $this->repo->update( $request->all() );

        flash()->success( trans( 'Role updated' ) );

        return redirect()->route( "admin.roles.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Role $role )
    {
        if ( is_null( $role ) ) return redirect()->route( 'admin.roles.index' );

        $this->repo->delete( $role->id );

        flash()->error( trans( 'common.Role #'.$role->id.' '.$role->name.' was deleted.' ) );

        return redirect()->route( "admin.roles.index" );
    }
}
