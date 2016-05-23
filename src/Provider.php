<?php namespace Williamoliveira\LaravelDebugger;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Williamoliveira\LaravelDebugger\Listeners\LogListener;
use Williamoliveira\LaravelDebugger\Listeners\QueryListener;
use Williamoliveira\LaravelDebugger\Services\NodeHttpSender;
use Williamoliveira\LaravelDebugger\Services\Sender;

/**
 * Class AttachableServiceProvider
 * @package Williamoliveira\Attachable\Providers
 */
class Provider extends EventServiceProvider
{

    protected $listen = [
        'illuminate.query' => [QueryListener::class],
        'illuminate.log' => [LogListener::class]
    ];

    public function boot(Dispatcher $events)
    {
        parent::boot($events);
    }

    public function register()
    {
        $this->app->singleton(Sender::class, NodeHttpSender::class);
    }
    
}