<?php

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once 'bootstrap.php';

use \App\Router;
use \App\Application;

$router = new Router();

$router->get('/',     function() {
    return 'home';
});
$router->get('/about', function() {
    return 'about';
});

$application = new Application($router);

$application->run();
