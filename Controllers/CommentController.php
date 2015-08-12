<?php

namespace Controllers;

use Core\Controller;
use Models\Comment;
use Core\Response;

class CommentController extends Controller
{
    public function createAction() {
        $resp = new Response();
        $request = $this->app->request;
        $post_id = $request->getPostParam('post_id');
        $content = $request->getPostParam('content');
        if ($post_id && $content) {
            $comment = new Comment(array(
                'post_id' => $post_id,
                'content' => $content,
                'user_id' => $this->app->user->getId()
            ));
            $comment->save();
        }
        $resp->redirectBack();
        return $resp;
    }
}