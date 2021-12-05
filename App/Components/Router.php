<?php

namespace App\Components;

use InvalidArgumentException;

class Router
{
    protected array $routes = [];

    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    public function post(string $path, $action): void
    {
        $this->routes['POST'][$path] = $action;
    }

    public function resolve()
    {
        //remove index.php ******************
        $path   = str_replace('/index.php', '', $this->request->getPath());
        $method = $this->request->getMethod();
        $action = $this->routes[$method][$path] ?? null;
        if (is_null($action)) {
            die('Not found!');
        }

        if (is_array($action)) {
            $this->renderController($action);
        }

        if (is_callable($action)) {
            call_user_func($action);
        }
    }

    protected function renderController($action): void
    {
        $class  = array_key_first($action);
        $method = array_shift($action);

        if (!method_exists($class, $method)) {
            throw new InvalidArgumentException("Method `$method` not found on $class");
        }

        (new $class)->$method();

    }
}