<?php namespace App\Providers;

use App\Handlers\Events\Auth\LoginAfterRegistration;
use App\Handlers\Events\Logger\LogEntitiesCreation;
use App\Handlers\Events\Logger\LogEntitiesDeletion;
use App\Handlers\Events\Logger\LogEntitiesUpdate;
use App\Handlers\Events\Logger\LogToDatabase;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [ 'entity.created*'        => [ LogEntitiesCreation::class, ],
                          'entity.updated*'        => [ LogEntitiesUpdate::class, ],
                          'entity.deleted*'        => [ LogEntitiesDeletion::class, ],
                          'illuminate.log'         => [ LogToDatabase::class, ],
                          UserWasRegistered::class => [ LoginAfterRegistration::class, ], ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot( DispatcherContract $events )
    {
        parent::boot( $events );
    }

}
