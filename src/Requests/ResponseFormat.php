<?php

namespace Jacksmall\LaravelDeepseek\Requests;

class ResponseFormat
{
    public $type = 'text';

    public function type(string $type)
    {
        $this->type = $type;

        return $this;
    }
}