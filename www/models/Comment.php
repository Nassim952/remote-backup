<?php

namespace cms\models;

use cms\core\DB;

class Comment extends DB{ 
    protected $comment;
    protected $post_date;
    protected $target;
    protected $target_type;
    protected $user_id;

    public function __Construct(){
        parent::__construct();
    }

    public function setComment($comment){
        $this->comment = $comment;
    }

    public function setPostDate($post_date){
        $this->post_date = $post_date;
    }

    public function setTarget($target){
        $this->target = $target;
    }

    public function setTargetType($target_type){
        $this->target_type = $target_type;
    }

    public function setUser($user_id){
        $this->user_id = $user_id;
    }


    public function getComment(){
        return $this->comment;
    }

    public function getPostDate(){
        return $this->post_date;
    }

    public function getTarget(){
        return $this->target = $target;
    }

    public function getTargetType(){
        return $this->target_type;
    }

    public function getUser($user_id){
        return $this->user_id;
    }

}