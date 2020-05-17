<?php 

namespace www\models;

use www\Managers\UserManager;

class user extends UserManager{

    protected $id = null;
    protected $firstname;
    protected $lastname;
    protected $login;
    protected $password;
    protected $type;

    public function __Construct(){
        $this->find($id);
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setFirstname($firstname){
        $this->firstname = trim($firstname);
    }

    public function setLastname($lastname){
        $this->lastname = trim($lastname);
    }

    public function setLogin($login){
        $this->login = trim($login);
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getId($id){
        return $this->id;
    }

    public function getFirstname($firstname){
       return $this->firstname;
    }

    public function getLastname($lastname){
       return $this->lastname;
    }
    
    public function getLogin($login){
        return $this->login;
    }

    public function getPassword($password){
        return $this->passwor;
    }

    public function getType($type){
        return $this->type;
    }
}