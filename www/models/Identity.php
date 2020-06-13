<?php

namespace cms\models;

use cms\core\DB;

class Component extends DB{ 
    protected $lastName;
    protected $firstName;
    protected $birthdate;

    public function __Construct(){
        parent::__construct();
    }


//SETTERS
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function setBirthdate($birthdate){
        $this->birthdate = $birthdate;
    }

//GETTERS
    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getBirthdate(){
        return $this->birthdate;
    }
}