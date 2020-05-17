<?php

namespace cms\models;

use cms\core\DB;

class User extends DB{
    protected $login;
    protected $password;
    protected $email;
    protected $statut;
    protected $right;
    protected $identity = null;


    public function __Construct(){
        parent::__construct();
    }

    public function setLogin($login){
        $this->login = $login;
    }


    public function setPassword($password){
        $this->password = $password;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setStatut($statut){
        $this->statut = $statut;
    }

    public function setRight($right){
        $this->right = $right;
    }

    public function setIdentity($identity){
        $this->identity = $identity;
    }




    public function getLogin(){
        return $this->login;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getStatut(){
        return $this->statut;
    }

    public function getRight(){
        return $this->right;
    }

    public function getIdentity(){
        return $this->identity;
    }

}