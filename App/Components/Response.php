<?php

namespace App\Components;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}