<?php

namespace cms\models;

use cms\core\Model;

class Room extends Model
{
    protected $id;
    protected $name;
    protected $cinema;
    protected $places;
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

    public function setCinema(string $cinema){
        $this->cinema = $cinema;
    }

    public function setPlaces(string $places){
        $this->places = $places;
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

    public function getCinema(){
        return $this->cinema;
    }

    public function getPlaces(){
        return $this->places;
    }

    public function getSection(){
        return $this->section;
    }

}