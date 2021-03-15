<?php

namespace App;

class Router
{
    public $routs = [];

    public function get(string $path, $function)
    {
        $this->routs[$path] = $function;
    }

    public function dispatch()
    {
        $url = $_SERVER['REQUEST_URI'];
        $key = parse_url($url, PHP_URL_PATH);
        $routs = $this->routs;
        $response = isset($routs[$key]) ? $routs[$key] : null;
        if ($response) {
            if (is_string($response)) {
                $response = explode('@', $response);
                $controller = new $response[0];
                $method = $response[1];
                $controller->$method();
            } else {
                echo $response();
            }
        }
    }
}
