<?php

namespace Models;

use Core\Model;
use Core\DB;

class Post extends Model
{
    protected static $table = 'posts';
    public $fields = array( 'id', 'user_id', 'title', 'content', 'created_at' );
    public $comments = array();

    public function getExcerpt() {
        $char_numb = 500;
        $text = $this->content;
        if (strlen($text) > $char_numb) {
            $text = substr($text, 0, $char_numb);
            $text = substr($text,0,strrpos($text," "));
            $etc = " ...";
            $text = $text.$etc;
        }
        return $text;
    }
    public function getCreationDate() {
        $date = new \DateTime($this->created_at);
        return $date->format(DATE_FORMAT);
    }
    public function save() {
        $dbh = self::getDBH();
        if ($this->id) {
            $sth = $dbh->prepare('UPDATE '.self::$table." SET title = :title, content = :content, created_at = NOW(), user_id = :user_id WHERE id = :id");
        } else {
            $sth = $dbh->prepare('INSERT INTO '.static::$table."(title, content, created_at, user_id) VALUES (:title, :content, NOW(), :user_id)");
        }
        $bindValues = array(
            ':title' => $this->title,
            ':content' => $this->content,
            ':user_id' => $this->user_id
        );
        $sth->execute($bindValues);
        return $dbh->lastInsertId();
    }
    public static function findWithComments($id) {
        $post = self::find($id);

        $sth = self::getDBH()->prepare('SELECT comments.*, users.login FROM comments LEFT JOIN users ON comments.user_id = users.id WHERE comments.post_id = :post_id ORDER BY comments.created_at DESC');
        $sth->execute(array(':post_id' => $id));
        while (($row = $sth->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $comment = new Comment($row);
            if (!is_null($row['user_id'])) {
                $comment->user = new User(array('id' => $row['user_id'], 'login' => $row['login']));
            }
            $post->comments[] = $comment;
        }
        return $post;
    }
}