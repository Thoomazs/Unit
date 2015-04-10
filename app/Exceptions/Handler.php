<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [ 'Symfony\Component\HttpKernel\Exception\HttpException' ];

    /**
     * Report or log an exception.
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report( Exception $e )
    {
        if ( ! config( 'app.debug' ) and $this->shouldntReport( $e ) )
        {
            Log::error( $e->getMessage(), [ 'icon' => 'fa-exclamation-circle' ] );
        }

        return parent::report( $e );
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render( $request, Exception $e )
    {
        if ( ! config( 'app.debug' ) )
        {
            $code = $e->getStatusCode();

            switch ( $code )
            {
                case 403:
                    return response( view( 'errors.403' ), 403 );

                case 404:
                    return response( view( 'errors.404' ), 404 );

                case 500:
                    return response( view( 'errors.500' ), 500 );

                default:
                    return response( view( 'errors.default', compact( 'code' ) ), $code );
            }
        }

        return parent::render( $request, $e );
    }

}
