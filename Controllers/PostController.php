<?php

namespace Controllers;

use Core\Response;
use Core\Controller;
use Models\Post;

class PostController extends Controller
{
    public function showAction($id) {
        $post = Post::findWithComments($id);
        return new Response('show_post.html', array('post' => $post));
    }
    public function newAction() {
        $post = new Post();
        return new Response('new_post.html', array('post' => $post));
    }
    public function createAction() {
        $request = $this->app->request;
        $resp = new Response();
        $errors = array();
        $title = $request->getPostParam('title');
        $content = $request->getPostParam('content');
        if (!$title) {
            $errors['title'] = 'Введите заголовок';
        }
        if (!$content) {
            $errors['content'] = 'Введите текст';
        }
        if (!$errors) {
            $post = new Post(array(
                'user_id' => $this->app->user->getId(),
                'title' => $title,
                'content' => $content
            ));
            if ($id = $post->save()) {
                $resp->redirect( $this->app->router->path('post.show',  array($id)) );
                return $resp;
            } else {
                $errors[] = 'Не удалось добавить пост';
            }
        }
        $resp->setTplVars( array('values' => array(
            'title' => $title,
            'content' => $content
        )) );
        $resp->setTplVars(array('errors' => $errors));
        $resp->setTemplate('new_post.html');
        return $resp;
    }
}