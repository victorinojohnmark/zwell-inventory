<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

## Observer Class ##
use App\Observers\PurchaseOrderObserver;
use App\Observers\DeliveryObserver;

## Models ##
use App\Transaction\PurchaseOrder;
use App\Transaction\Delivery;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        PurchaseOrder::observe(PurchaseOrderObserver::class);
        Delivery::observe(DeliveryObserver::class);
    }
}
