<?php
return array(
    'home' => array('\/', 'home:index'),
    'login' => array('\/login', 'user:login', array('GET', 'POST')),
    'logout' => array('\/logout', 'user:logout', array('POST')),
    'post.show' => array('\/posts\/(\d+)', 'post:show'),
    'comment.create' => array('\/comments', 'comment:create', array('POST')),
    'post.new' => array('\/posts\/new', 'post:new', array('GET'), true),
    'post.create' => array('\/posts', 'post:create', array('POST'), true)
);
