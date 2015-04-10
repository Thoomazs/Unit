<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

class Admin
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard           $auth
     *
     * @return void
     */
    public function __construct( Guard $auth )
    {
        $this->auth     = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        if ( $this->auth->guest() )
        {
            if ( $request->ajax() )
            {
                return $this->response->make( 'Unauthorized', 401 );
            }
            else
            {
                return redirect()->guest( route( 'auth.login' ) );
            }
        }
        else if ( ! $this->auth->user()->hasRole( 'Admin' ) )
        {
            Session::flash( 'msg-danger', trans( 'messages.permission' ) );

            return redirect( '/' );
        }

        return $next( $request );
    }

}
