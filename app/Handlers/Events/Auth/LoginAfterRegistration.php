<?php namespace App\Handlers\Events;

use App\Events\UserWasRegistered;
use Illuminate\Contracts\Auth\Guard as Auth;

class LoginAfterRegistration
{

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct( Auth $auth )
    {
        $this->auth = $auth;
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
        dd($event->user);
        $this->auth->login( $event->user );
    }

}
