<?php namespace App\Handlers\Events\Logger;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Log\Writer as Log;

class LogEntitiesUpdate
{
    protected $log;


    public function __construct( Log $log )
    {
        $this->log = $log;
    }


    public function handle( Arrayable $entity )
    {
        if ( $entity instanceof \App\Models\Log ) return;

        $context = [ 'icon' => 'fa-pencil' ];

        $this->log->info( get_class( $entity )." was updated:\n\n ".var_export( $entity->toArray(), true ), $context );
    }
}
