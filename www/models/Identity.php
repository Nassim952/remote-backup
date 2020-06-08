<?php

namespace cms\models;

use wwww\core\DB;

class Component extends DB{ 
    protected $name;
    protected $surname;
    protected $birthdate;

    public function __Construct(){
        parent::__construct();
    }


//SETTERS
    public function setName($nnameom){
        $this->name = $name;
    }

    public function setSurname($surname){
        $this->surname = $surname;
    }

    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }

//GETTERS
    public function getName(){
        return $this->name;
    }

    public function getSurname(){
        return $this->surname;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }
}