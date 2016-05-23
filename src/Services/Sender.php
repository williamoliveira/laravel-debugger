<?php

namespace Williamoliveira\LaravelDebugger\Services;


interface Sender
{
    /**
     * @param $channel string
     * @param $data array|string
     * @return mixed
     */
    public function send($channel, $data);
}