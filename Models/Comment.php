<?php

namespace Models;

use Core\Model;

class Comment extends Model
{
    protected static $table = 'comments';
    public $fields = array('id', 'post_id', 'user_id', 'content', 'created_at');
    public $user;
    public function save() {
        $dbh = self::getDBH();
        if ($this->id) {
            $sth = $dbh->prepare('UPDATE '.self::$table." SET post_id = :post_id, content = :content, created_at = NOW(), user_id = :user_id WHERE id = :id");
        } else {
            $sth = $dbh->prepare('INSERT INTO '.static::$table."(post_id, content, created_at, user_id) VALUES (:post_id, :content, NOW(), :user_id)");
        }
        $bindValues = array(
            ':post_id' => $this->post_id,
            ':content' => $this->content,
            ':user_id' => $this->user_id
            );
        $sth->execute($bindValues);
        return $dbh->lastInsertId();
    }
    public function getCreationDate() {
        $date = new \DateTime($this->created_at);
        return $date->format(DATE_FORMAT);
    }
}