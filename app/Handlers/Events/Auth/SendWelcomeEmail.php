<?php namespace App\Handlers\Events;

use App\Events\UserWasRegistered;
use Illuminate\Contracts\Auth\Guard as Auth;
use Illuminate\Contracts\Mail\Mailer;

class LoginAfterRegistration
{

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct( Mailer $mailer )
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasRegistered $event
     *
     * @return void
     */
    public function handle( UserWasRegistered $event )
    {
        // mail
        $this->mailer->send( 'emails.request', compact( 'data' ), function ( $m ) use ( $data )
        {
            $m->subject( 'Poptávka financování pro '.$data[ "name" ] );
            $m->from( 'poptavka@srovnavacfinancovani.cz', 'SrovnávačFinancování' );
            $m->to( $data[ 'email' ] );
            $m->bcc( 'poptavka@srovnavacfinancovani.cz' );
        } );
    }

}
