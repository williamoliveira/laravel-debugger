<?php

namespace Williamoliveira\LaravelDebugger\Services;


class NodeHttpSender implements Sender
{

    protected $httpClient;

    /**
     * NodeSender constructor.
     */
    public function __construct()
    {
        $this->httpClient = new \GuzzleHttp\Client();
    }

    
    public function send($channel, $data)
    {
        try{
            return $this->httpClient->post('http://localhost:3000/new-message', [
                'json' => [
                    'channel' => $channel,
                    'data' => $data
                ]
            ]);
        }
        catch (\Exception $ex){
            //shhh
        }

        return null;
    }


}