<?php namespace App\Http\Controllers\Auth;

use App\Commands\User\RegisterUserCommand;
use App\Events\UserWasRegistered;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\UserRepository;
use App\Support\Controller;
use Illuminate\Contracts\Auth\Guard as Auth;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\User
 */
class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Show the application registration form.
     *
     * @return Response
     */
    public function getRegister()
    {
        $form = \FormBuilder::create( 'Auth\RegisterForm' );

        return view( 'site.users.auth.register', compact( 'form' ) );
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  RegisterRequest $request
     *
     * @return Response
     */
    public function postRegister( RegisterRequest $request, UserRepository $userRepository )
    {
        $user = $userRepository->create( $request->all() );

        \Event::fire( new UserWasRegistered($user) );

        return redirect()->route( "home" );
    }

    /**
     * Show the application login form.
     *
     * @return Response
     */
    public function getLogin()
    {
        $form = \FormBuilder::create( 'Auth\LoginForm' );

        return view( 'site.users.auth.login', compact( 'form' ) );
    }

    /**
     * Handle a login request to the application.
     *
     * @param  LoginRequest $request
     *
     * @return Response
     */
    public function postLogin( LoginRequest $request, Auth $auth )
    {
        $login = $auth->attempt( $request->only( 'email', 'password' ), $request->has( 'remember' ) );

        if ( ! $login ) return redirect()->route( 'auth.login' )->withErrors( [ 'email' => 'These credentials do not match our records.' ] );

        return redirect()->intended( route( 'home' ) );
    }

    /**
     * Log the user out of the application.
     *
     * @return Response
     */
    public function getLogout( Auth $auth )
    {
        $auth->logout();

        return redirect( '/' );
    }

}
