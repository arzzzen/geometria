<?php
    // Register autoloader
    spl_autoload_register(function ($class)
    {
        $filename = dirname(__DIR__).DIRECTORY_SEPARATOR.str_replace('\\','/',$class).'.php';
        if (is_readable($filename)) {
            require_once $filename;
        }
    });

    // Run app
    use Core\App;
    $app = new App();
    $app->run();