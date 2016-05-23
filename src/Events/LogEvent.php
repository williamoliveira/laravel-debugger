<?php
namespace Williamoliveira\LaravelDebugger\Events;

use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class LogEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $level, $message, $context;

    /**
     * LogEvent constructor.
     * @param $level
     * @param $message
     * @param $context
     */
    public function __construct($level, $message, $context)
    {
        $this->level = $level;
        $this->message = $message;
        $this->context = $context;
    }


    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'new-log';
    }

    public function broadcastOn()
    {
        return ['laravel-debugger'];
    }
}