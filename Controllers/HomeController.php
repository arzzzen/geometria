<?php

namespace Controllers;

use Core\Response;
use Core\Controller;
use Models\Post;

class HomeController extends Controller
{
    public function indexAction() {
        $posts = Post::findAll('ORDER BY created_at DESC');
        return new Response('index.html', array('posts' => $posts));
    }
}