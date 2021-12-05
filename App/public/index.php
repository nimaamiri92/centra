<?php

use App\Bootstrap\Application;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../../vendor/autoload.php';


$app = new Application();

$app->router->get('/',function(){
    echo '<pre>';
    var_dump('nima');
    echo '</pre>';
    exit();
});

$app->run();