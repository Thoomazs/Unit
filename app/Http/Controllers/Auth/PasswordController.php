<?php namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\EmailPasswordLinkRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Request;
use App\Support\Controller;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Contracts\Auth\PasswordBroker as Password;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PasswordController extends Controller
{

    protected $password;

    /**
     * Create a new password controller instance.
     *
     * @param  PasswordBroker $passwords
     *
     * @return void
     */
    function __construct( Password $password )
    {
        parent::__construct();

        $this->password = $password;
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return Response
     */
    public function getEmail()
    {
        $form = \FormBuilder::create( 'Password\EmailForm' );

        return view( 'site.users.password.email', compact( 'form' ) );
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function postEmail( EmailPasswordLinkRequest $request )
    {
        $response = $this->password->sendResetLink( $request->only( 'email' ) );

        if ( $response == Password::INVALID_USER )
        {
            return redirect()->back()->withInput()->withErrors( [ 'email' => trans( $response ) ] );
        }

        flash( trans( 'messages.passwords.sent' ) );

        return redirect()->route( "home" );
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string $token
     *
     * @return Response
     */
    public function getReset( $token = null )
    {
        if ( is_null( $token ) ) throw new NotFoundHttpException;

        $form = \FormBuilder::create( 'Password\ResetForm', [ 'data' => [ 'token' => $token ] ] );

        return view( 'site.users.password.reset', compact( 'form' ) );
    }

    /**
     * Reset the given user's password.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function postReset( ResetPasswordRequest $request, Auth $auth )
    {

        $response = $this->password->reset( $request->only( 'email', 'password', 'password_confirmation', 'token' ), function ( $user, $password )
        {
            $user->password = $password;

            $user->save();
        } );


        if ( $response !== Password::PASSWORD_RESET )
        {
            return redirect()->back()->withInput( $request->only( 'email' ) )->withErrors( $this->getErrorMessages( $response ) );
        }


        $auth->attempt( $request->only( 'email', 'password' ) );

        return redirect()->route( "home" );
    }

    private function getErrorMessages( $response )
    {
        switch ( $response )
        {
            case Password::INVALID_PASSWORD:
                return [ 'password' => trans( $response ) ];
            case Password::INVALID_TOKEN:
                return [ 'token' => trans( $response ) ];
            case Password::INVALID_USER:
                return [ 'email' => trans( $response ) ];
        }
    }

}
