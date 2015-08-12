<?php

namespace Core;

class App
{
    public $router;
    public $user;

    public function __construct() {
        $this->loadConfig('config');

        $this->request = new Request();
        $this->router = new Router($this);
        $this->user = new User();
        DB::setConfig($this->loadConfig('db'));
    }
    public function run() {
        try {
            if (!$this->router->match($this->request->getMethod(), $this->request->getUrl())) {
                throw new \Exception('No route match url', 404);
            }
            $controllerClass = '\\Controllers\\'.ucfirst($this->router->getController()).'Controller';
            $action = $this->router->getAction().'Action';
            $controller = new $controllerClass($this);
            $response = call_user_func_array(array($controller, $action), $this->router->getParameters());
            $response->setApp($this);
            $response->render();
        } catch (\Exception $e) {
            $code = $e->getCode() === 404 ? 404 : 500;
            $response = new Response($code.'.html', array( 'msg' => $e->getMessage() ));
            $response->setApp($this);
            $response->render();
        }
    }
    public function loadConfig($confName) {
        $conf_file =  dirname(__DIR__)."/config/$confName.php";
        if (!is_readable($conf_file)) {
            throw new \Exception("Can't read config file \"$conf_file\"");
        }
        return include($conf_file);
    }
}