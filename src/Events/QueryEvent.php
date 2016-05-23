<?php
namespace Williamoliveira\LaravelDebugger\Events;

use App\Events\Event;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class QueryEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $preparedSql, $sql, $bindings, $time, $connectionName;

    /**
     * QueryEvent constructor.
     * @param $preparedSql
     * @param $sql
     * @param $bindings
     * @param $time
     * @param $connectionName
     */
    public function __construct($preparedSql, $sql, $bindings, $time, $connectionName)
    {
        $this->preparedSql = $preparedSql;
        $this->sql = $sql;
        $this->bindings = $bindings;
        $this->time = $time;
        $this->connectionName = $connectionName;
    }


    /**
     * Get the broadcast event name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'new-query';
    }

    public function broadcastOn()
    {
        return ['laravel-debugger'];
    }
}