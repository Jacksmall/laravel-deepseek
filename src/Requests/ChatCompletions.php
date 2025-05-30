<?php

namespace Jacksmall\LaravelDeepseek\Requests;

class ChatCompletions
{
    public $messages;
    public $model;
    public $frequency_penalty = 0;
    public $max_tokens = 4096;
    public $presence_penalty = 0;
    public ResponseFormat $response_format;
    public $stop = null;
    public $stream;
    public $temperature = 1;
    public $top_p = 1;
    public $tools = null;
    public $tool_choice = null;
    public $logprobs = false;
    public $top_logprobs = null;

    /**
     * @param mixed $messages
     */
    public function messages($messages)
    {
        $this->messages = $messages;

        return $this;
    }

    public function model($model)
    {
        if (!in_array($model, ['deepseek-chat', 'deepseek-reasoner'])) {
            throw new \Exception('Model not supported');
        }

        $this->model = $model;

        return $this;
    }

    public function frequency_penalty($frequency_penalty)
    {
        if ($frequency_penalty < -2 || $frequency_penalty > 2) {
            throw new \Exception('Frequency penalty must be between -2 and 2');
        }

        $this->frequency_penalty = $frequency_penalty;

        return $this;
    }

    public function max_tokens($max_tokens)
    {
        if ($max_tokens <= 0 || $max_tokens > 8192) {
            throw new \Exception('Max tokens must be between 0 and 8192');
        }

        $this->max_tokens = $max_tokens;

        return $this;
    }

    public function presence_penalty($presence_penalty)
    {
        if ($presence_penalty < -2 || $presence_penalty > 2) {
            throw new \Exception('Presence penalty must be between -2 and 2');
        }

        $this->presence_penalty = $presence_penalty;

        return $this;
    }

    public function response_format($response_format)
    {
        if (!in_array($response_format['type'], ['text', 'json_object'])) {
            throw new \Exception('Response format not supported');
        }

        $rf = new ResponseFormat();
        $rf->type($response_format['type']);
        $this->response_format = $rf;

        return $this;
    }

    public function stop($stop)
    {
        $this->stop = $stop;

        return $this;
    }

    public function stream($stream)
    {
        if (!in_array($stream, [true, false])) {
            throw new \Exception('Stream must be true or false');
        }

        $this->stream = $stream;

        return $this;
    }

    public function temperature($temperature)
    {
        if ($temperature < 0 || $temperature > 2) {
            throw new \Exception('Temperature must be between 0 and 2');
        }
        $this->temperature = $temperature;

        return $this;
    }

    public function top_p($top_p)
    {
        if ($top_p < 0 || $top_p > 1) {
            throw new \Exception('Top p must be between 0 and 1');
        }

        $this->top_p = $top_p;

        return $this;
    }

    public function tools($tools)
    {
        $this->tools = $tools;

        return $this;
    }

    public function tool_choice($tool_choice)
    {
        $this->tool_choice = $tool_choice;

        return $this;
    }

    public function logprobs($logprobs)
    {
        if (!in_array($logprobs, [true, false])) {
            throw new \Exception('Logprobs must be true or false');
        }
        $this->logprobs = $logprobs;

        return $this;
    }

    public function top_logprobs($top_logprobs)
    {
        if ($top_logprobs < 0 || $top_logprobs > 20) {
            throw new \Exception('Top logprobs must be between 0 and 20');
        }
        $this->top_logprobs = $top_logprobs;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'messages' => $this->messages,
            'model' => $this->model,
            'frequency_penalty' => $this->frequency_penalty,
            'max_tokens' => $this->max_tokens,
            'presence_penalty' => $this->presence_penalty,
            'response_format' => $this->response_format instanceof ResponseFormat
                ? (array)$this->response_format
                : $this->response_format,
            'stop' => $this->stop,
            'stream' => $this->stream,
            'temperature' => $this->temperature,
            'top_p' => $this->top_p,
            'tools' => $this->tools,
            'tool_choice' => $this->tool_choice,
            'logprobs' => $this->logprobs,
            'top_logprobs' => $this->top_logprobs,
        ], function ($value) {
            return !is_null($value);
        });
    }
}