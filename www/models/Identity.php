<?php

namespace cms\models;

use wwww\core\Model;

class Identity extends Model
{ 
    protected $id;
    protected $name;
    protected $surname;
    protected $birthdate;

    public function __Construct($id){
        $identity = new IdentityManager();
        $identity->find($id);
    }


//SETTERS
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($nnameom)
    {
        $this->name = $name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

//GETTERS
    public function getId()
    {
    return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }
}