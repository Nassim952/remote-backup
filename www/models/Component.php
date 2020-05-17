<?php

namespace cms\models;

use cms\core\DB;

class Component extends DB{ 
    protected $title;
    protected $class;
    protected $type;
    protected $style;

    public function __Construct(){
        parent::__construct();
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setClass($class){
        $this->title = $class;
    }

    public function setPassword($type){
        $this->type = $type;
    }

    public function setStyle($style){
        $this->style = $style;
    }

    public function getTitle(){
       return $this->title;
    }

    public function getClass(){
        return $this->title;
    }

    public function getPassword($type){
        return $this->type;
    }

    public function getStyle($style){
        return $this->style;
    }
}