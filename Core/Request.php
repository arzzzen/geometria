<?php

namespace Core;


class Request
{
    private $url;
    private $parameters = array();
    private $method;
    public function __construct() {
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $this->url = $uri_parts[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    public function getMethod() {
        return $this->method;
    }
    public function getUrl() {
        return $this->url;
    }
    public function getParam($param, $default = null) {
        return isset($_GET[$param]) ? $_GET[$param] : $default;
    }
    public function getPostParam($param, $default = null) {
        return isset($_POST[$param]) ? $_POST[$param] : $default;
    }
    public function  is($method) {
        return $this->getMethod() === $method;
    }
}