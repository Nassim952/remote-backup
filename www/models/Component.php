<?php

namespace cms\models;

use cms\core\DB;

class Component extends DB{ 
    protected $title;
    protected $class;
    protected $type;
    protected $style;

    public function __construct(){
        parent::__construct();
    }

//SETTERS
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

//GETTERS
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