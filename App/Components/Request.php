<?php

namespace App\Components;

class Request
{
    public function getPath(): string
    {
        $path     = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position) {
            return substr($path, 0, $position);
        }

        return $path;
    }

    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}