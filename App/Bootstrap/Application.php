<?php

namespace App\Bootstrap;

use App\Components\Request;
use App\Components\Response;
use App\Components\Router;

class Application
{

    public Router $router;

    public Request $request;

    public Response $response;

    public function __construct()
    {
        $this->request  = new Request();
        $this->response = new Response();
        $this->router   = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
}