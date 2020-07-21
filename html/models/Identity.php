<?php

namespace cms\models;

use wwww\core\Model;

class Identity extends Model
{ 
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $birthdate;

    public function __Construct($id){
        $identity = new IdentityManager();
        $identity->find($id);
    }


//SETTERS
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

//GETTERS
    public function getFirstName(){
        return $this->firstName;
    }

    public function getLastName(){
        return $this->lastName;
    }

    public function getId()
    {
    return $this->id;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }
}