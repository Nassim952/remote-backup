<?php

namespace www\models;

use www\core\Model;

class Room extends Model
{
    protected $id;
    protected $name;
    protected $section;
    
    public function __Construct()
    {
    
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function setSection(string $section){
        $this->section = $section;
    }

//GETTERS
    public function getId()
    {
    return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getSection(){
        return $this->section;
    }

}