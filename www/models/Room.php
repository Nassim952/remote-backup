<?php

namespace www\models;

use www\core\DB;

class Room extends DB{
    protected $name;
    protected $section;
    
    public function __Construct(){
        parent::__construct();
    }

//SETTERS
    public function setName(string $name){
        $this->name = $name;
    }

    public function setSection(string $section){
        $this->section = $section;
    }

//GETTERS
    public function getName(){
        return $this->name;
    }

    public function getSection(){
        return $this->section;
    }

}