<?php

namespace Jacksmall\LaravelDeepseek\Services;

use GuzzleHttp\Client as Http;
use Jacksmall\LaravelDeepseek\Requests\ChatCompletions;

class Client
{
    public $http;
    public $config;

    public function __construct(Http $http, $config)
    {
        $this->http = $http;
        $this->config = $config;
    }

    public function sendChat(ChatCompletions $request)
    {
        return $this->http->post($this->config['base_url'] . '/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config['api_key'],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => $request->toArray(),
        ]);
    }
}