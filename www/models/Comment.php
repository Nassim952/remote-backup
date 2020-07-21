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
    protected $user_id;
   

    public function initRelation(): array {
        return [
        
        ];
    }
    
    /**
     * Get the value of id
     */ 
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

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of post_date
     */ 
    public function getPost_date()
    {
        return $this->post_date;
    }

    /**
     * Set the value of post_date
     *
     * @return  self
     */ 
    public function setPost_date($post_date)
    {
        $this->post_date = $post_date;

        return $this;
    }

    /**
     * Get the value of target
     */ 
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set the value of target
     *
     * @return  self
     */ 
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }


    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }


}