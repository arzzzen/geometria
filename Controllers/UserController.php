<?php

namespace Controllers;

use Core\Response;
use Core\Controller;

class UserController extends Controller
{
    public function loginAction() {
        $request = $this->app->request;
        $resp = new Response();
        $errors = array();
        if ($request->is('POST')) {
            $login = $request->getPostParam('login');
            $pass = $request->getPostParam('pass');
            if (!$login) {
                $errors['login'] = 'Введите логин';
            }
            if (!$pass) {
                $errors['pass'] = 'Введите пароль';
            }
            if (!$errors) {
                if ($this->app->user->login($login, $pass)) {
                    $resp->redirect($this->app->router->path('home'));
                    return $resp;
                } else {
                    $errors[] = 'Логин или пароль неверен';
                }
            }
            $resp->setTplVars( array('values' => array(
                'login' => $login,
                'pass' => $pass
            )) );
        }
        $resp->setTplVars(array('errors' => $errors));
        $resp->setTemplate('login.html');
        return $resp;
    }
    public function logoutAction() {
        $this->app->user->logout();
        $resp = new Response();
        $resp->redirect($this->app->router->path('home'));
        return $resp;
    }
}