<?php

namespace Models;

use Core\Model;

class User extends Model
{
    protected static $table = 'users';
    public $fields = array('id', 'login', 'pass');
}