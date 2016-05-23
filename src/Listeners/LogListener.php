<?php

namespace Williamoliveira\LaravelDebugger\Listeners;

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


    public function handle($level, $message, $context)
    {
        $data = compact('level', 'message', 'context');

        $this->sender->send($this->channel, $data);
    }
}