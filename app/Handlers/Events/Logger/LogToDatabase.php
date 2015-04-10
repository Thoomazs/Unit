<?php namespace App\Handlers\Events\Logger;

use App\Models\LogRepository;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogToDatabase implements ShouldBeQueued
{
    use InteractsWithQueue;

    protected $repo;


    /**
     * @param LogRepository $logRepository
     */
    public function __construct( LogRepository $logRepository )
    {
        $this->repo = $logRepository;
    }


    /**
     * @param $level
     * @param $message
     * @param $context
     */
    public function handle( $level, $message, $context )
    {
        $this->repo->create( [ "level"   => $level,
                               "user_id" => ( Auth::check() ) ? Auth::user()->id : null,
                               "message" => $message,
                               "icon"    => ( isset( $context[ "icon" ] ) ) ? $context[ "icon" ] : 'fa-circle-o',
                               "ip"      => Request::ip() ] );

    }

}
