<?php

namespace Williamoliveira\LaravelDebugger\Listeners;

use Illuminate\Log\Events\MessageLogged;
use Williamoliveira\LaravelDebugger\Services\Sender;

class LogListener
{
    protected $channel = 'laravel-debugger:new-log';
    
    protected $sender;

    /**
     * QueryListener constructor.
     * @param $sender
     */
    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function handle(MessageLogged $event)
    {
        $data = [
          'level' => $event->level,
          'message' => $event->message,
          'context' => $event->context,
        ];

        $this->sender->send($this->channel, $data);
    }
}
