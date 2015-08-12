<?php

namespace Core;

use Models\User as UserModel;

class User
{
    private $model;
    public function __construct() {
        session_start();
    }
    public function login($login, $pass) {
        $hashed_pass = hash('sha512', $login. $pass.PASS_SALT);
        $users = UserModel::findAll('WHERE login = :login AND pass = :pass', array(
            ':login' => $login,
            ':pass' => $hashed_pass
        ));
        if (!count($users)) {
            return false;
        } else {
            $user = $users[0];
            $this->model = $user;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_login'] = $user->login;
            return true;
        }
    }
    public function logout() {
        session_destroy();
    }
    public function isAuthorized() {
        return isset($_SESSION['user_id']);
    }
    public function getId() {
        return @$_SESSION['user_id'];
    }
    public function getLogin() {
        return @$_SESSION['user_login'];
    }
}