<?php namespace Williamoliveira\LaravelDebugger\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Williamoliveira\LaravelDebugger\Events\LogEvent;
use Williamoliveira\LaravelDebugger\Events\QueryEvent;

/**
 * Class AttachableServiceProvider
 * @package Williamoliveira\Attachable\Providers
 */
class Laravel5Provider extends ServiceProvider
{

    public function boot(Dispatcher $events)
    {
        $events->listen('illuminate.query', function ($sql, $bindings, $time, $connectionName) use ($events) {

                $preparedSql = $this->sprintfSql($sql, $bindings);

                $events->fire(
                    new QueryEvent($preparedSql, $sql, $bindings, $time, $connectionName)
                );
            });

        $events->listen('illuminate.log', function($level, $message, $context) use ($events) {
            $events->fire(new LogEvent($level, $message, $context));
        });
    }

    public function register()
    {

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