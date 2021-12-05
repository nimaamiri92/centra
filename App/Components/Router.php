<?php

namespace App\Components;

use Closure;

class Router
{
    protected array $routes = [];

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, Closure $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, Closure $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve(): void
    {
        //remove index.php ******************
        $path   = str_replace('/index.php', '', $this->request->getPath());
        $method = $this->request->getMethod();
        $action = $this->routes[$method][$path] ?? null;
        if (is_null($action)) {
            die('Not found!');
        }
        call_user_func($action);
    }
}