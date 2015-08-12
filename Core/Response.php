<?php

namespace Core;


class Response
{
    private $app;
    private $layout;
    private $template;
    private $vars = array();
    private $headers = array();

    public function __construct($template = null, $vars = array(), $layout = 'layout.html') {
        if ($template) {
            $this->setTemplate($template);
        }
        if ($layout) {
            $this->setLayout($layout);
        }
        $this->setTplVars($vars);
    }
    public function setApp(App $app) {
        $this->app = $app;
    }
    public function setTemplate($template) {
        $this->template = APP_DIR."/views/$template.php";
    }
    public function setLayout($layout) {
        $this->layout = APP_DIR."/views/$layout.php";
    }
    public function setTplVars($vars) {
        $this->vars = array_merge($this->vars, $vars);
    }
    public function render($display = true) {
        $output = '';
        if ($this->template) {
            $output = $this->renderFile($this->template, $this->vars);
        }
        if ($this->layout) {
            $output = $this->renderFile($this->layout, array_merge($this->vars, array('tpl_content' => $output)));
        }
        if ($display) {
            $this->setHeaders();
            echo $output;
        } else {
            return $output;
        }
    }
    public function addHeader($header, $replace = true, $http_response_code = null) {
        $this->headers[] = array($header, $replace, $http_response_code);
    }
    public function redirect($location, $code = 302) {
        $this->addHeader("Location: $location", true, $code);
    }
    public function redirectBack() {
        $this->addHeader('Location: ' . $_SERVER['HTTP_REFERER'], true);
    }
    private function setHeaders() {
        foreach ($this->headers as $header) {
            header($header[0], @$header[1], @$header[2]);
        }
    }
    private function renderFile($file, $vars) {
        ob_start();
        extract($vars);
        $app = $this->app;
        require $file;
        $contents = ob_get_contents();
        ob_clean();
        return $contents;
    }

}