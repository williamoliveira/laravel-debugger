<?php namespace Williamoliveira\LaravelDebugger;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Log\Events\MessageLogged;
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
        QueryExecuted::class => [ QueryListener::class ],
        MessageLogged::class => [ LogListener::class ]
    ];

    public function register()
    {
        $this->app->singleton(Sender::class, NodeHttpSender::class);
    }
    
}