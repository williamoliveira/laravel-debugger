<?php

namespace Williamoliveira\LaravelDebugger\Listeners;

use Williamoliveira\LaravelDebugger\Services\Sender;

class QueryListener
{

    protected $channel = 'laravel-debugger:new-query';
    
    protected $sender;

    /**
     * QueryListener constructor.
     * @param $sender
     */
    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }


    public function handle($sql, $bindings, $time, $connectionName)
    {
        $preparedSql = $this->sprintfSql($sql, $bindings);
        $data = compact('preparedSql', 'sql', 'bindings', 'time', 'connectionName');

        $this->sender->send($this->channel, $data);
    }
    
    protected function sprintfSql($sql, $bindings)
    {
        // Process the sql and the bindings:
        foreach ($bindings as $i => $binding) {

            if ($binding instanceof \DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                continue;
            }

            if (is_string($binding)) {
                $bindings[$i] = "'$binding'";
            }
        }

        // Insert bindings into query
        $sql = str_replace(['%', '?'], ['%%', '%s'], $sql);

        return vsprintf($sql, $bindings);
    }
}