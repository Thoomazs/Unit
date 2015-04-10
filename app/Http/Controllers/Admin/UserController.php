<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\DestroyRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRepository;
use Illuminate\Http\Request;

/**
 * Class UsersController
 */
class UserController extends Controller
{


    /**
     * @param UserRepository $userRepository
     */
    function __construct( UserRepository $userRepository )
    {
        $this->repo = $userRepository;
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index( Request $request )
    {
        $s = $request->get( 's' );

        if ( $s ) $this->repo->search( $s );

        $users = $this->repo->paginate();

        if ( $s and count( $users ) == 1 ) return redirect()->route( "admin.users.edit", [ $users->first()->id ] );

        return view( 'admin.users.index', compact( 'users' ) );
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $form =  \FormBuilder::create( 'App\Forms\Admin\UserForm', ['method' => 'POST', 'url' => route( 'admin.users.store' )] );

        return view( 'admin.users.create', compact( 'form' ) );
    }

    /**
     * @param CreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store( CreateRequest $request )
    {
        $user = $this->repo->create( $request->all() );

        flash()->success( trans('messages.User created') );

        return redirect()->route( "admin.users.edit", [ $user->id ] );
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show( User $user )
    {
        return redirect()->route( 'admin.users.edit', [ $user->id ] );
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit( User $user )
    {
        if ( is_null( $user ) ) return redirect()->route( 'admin.users.index' );

        $form =  \FormBuilder::create( 'App\Forms\Admin\UserForm', ['method' => 'PATCH', 'url' => route( 'admin.users.update', [ $user->id ] ), 'model' => $user ] );

        return view( 'admin.users.edit', compact( 'user', 'form' ) );
    }

    /**
     * @param UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update( UpdateRequest $request )
    {
        $user = $this->repo->update( $request->all() );

        flash()->success( trans('messages.User updated') );

        return redirect()->route( "admin.users.edit", [ $user->id ] );
    }

    /**
     * @param Request $request
     * @param User    $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy( DestroyRequest $request, User $user )
    {
        if ( is_null( $user ) ) return redirect()->route( 'admin.users.index' );

        $this->repo->delete( $user->id );

        flash()->warning( trans('messages.User deleted') );

        return redirect()->route( "admin.users.index" );
    }
}
