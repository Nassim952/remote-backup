<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;
use cms\managers\CommentManager;

class Comment extends Model implements ModelInterface
{ 
    protected $id;
    protected $comment;
    protected $post_date;
    protected $target;
    protected $target_type;
    protected $user_id;
    protected $author;

    public function initRelation(): array {
        return [
        
        ];
    }

    public function delete($id){
        $commentManager = new CommentManager(Comment::class, 'comment');

        $commentManager->deleteComment($id);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
         * Set the value of id
         *
         * @return  self
         */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
        return $this->target;
    }

    public function getTargetType()
    {
        return $this->target_type;
    }

    public function getAuthor()
    {
        return $this->author;
    }

}