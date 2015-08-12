<?php

namespace Core;

class Router
{
    private $app;
    private $routes = array();
    private $controller;
    private $action;
    private $parameters = array();
    public function __construct(App $app) {
        $this->app = $app;
        $this->routes = $this->app->loadConfig('routes');
    }
    public function getController() {
        return $this->controller;
    }
    public function getAction() {
        return $this->action;
    }
    public function getParameters() {
        return $this->parameters;
    }
    public function match($method, $url) {
        foreach($this->routes as $route) {
            $matches = array();
            $pattern = '/^' . $route[0] . '$/';
            $allowed_methods = isset($route[2]) ? $route[2] : array('GET');
            preg_match($pattern, $url, $matches);
            $authorized = @$route[3] === true ? $this->app->user->isAuthorized() : true;
            if ($matches && in_array($method, $allowed_methods) && $authorized) {
                list($this->controller, $this->action) = explode(':', $route[1]);
                array_shift($matches);
                $this->parameters = $matches;
                return true;
            }
        }
        return false;
    }
    public function path($route_name, $params = array()) {
        if (!isset($this->routes[$route_name])) {
            throw new \Exception("Can't generate route. No route \"$route_name\"");
        }
        $pattern = $this->routes[$route_name][0];
        $path = preg_replace_callback('/\(.+\)/', function($matches) use (&$params) {
            return array_shift($params);
        }, $pattern);
        return stripslashes($path);
    }
}