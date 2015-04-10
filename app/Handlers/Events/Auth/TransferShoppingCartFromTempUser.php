<?php namespace App\Handlers\Events\Auth;

use App\Models\UserRepository;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class TransferShoppingCartFromTempUser
{

    protected $service;

    protected $userRepo;

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct( OrderService $orderService, UserRepository $userRepository )
    {
        $this->service  = $orderService;
        $this->userRepo = $userRepository;
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        // set from temp user
        $from = Cookie::get( 'tempUser' );

        // to the now-login-user
        $to = Auth::user()->id;

        // transfer cart
        $this->service->transferCart( $from, $to );

        // delete temp user
        Cookie::queue( 'tempUser', null, -1 );
        $this->userRepo->delete( $from );
    }


}
