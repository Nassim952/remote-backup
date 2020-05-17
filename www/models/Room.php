<?php

namespace cms\models;

use cms\core\DB;

class Room extends DB{
    protected $name;
    protected $section;
    
    public function __Construct(){
        parent::__construct();
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setSection(string $section){
        $this->section = $section;
    }


    public function getName(){
        return $this->name;
    }

    public function getSection(){
        return $this->section;
    }

}