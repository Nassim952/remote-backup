<?php

namespace cms\models;

use cms\core\DB;

class Comment extends DB
{ 
    protected $id;
    protected $comment;
    protected $post_date;
    protected $target;
    protected $target_type;
    protected $author;

    public function __Construct($id)
    {
        $comment = new CommentManager();
        $comment->find($id); 
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function setPostDate($post_date)
    {
        $this->post_date = $post_date;
    }

    public function setTarget($target)
    {
        $this->target = $target;
    }

    public function setTargetType($target_type)
    {
        $this->target_type = $target_type;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }



//GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getPostDate()
    {
        return $this->post_date;
    }

    public function getTarget()
    {
        return $this->target = $target;
    }

    public function getTargetType()
    {
        return $this->target_type;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function initRealation():array
    {
        return [
            'author' => User::class
        ];
    }

}