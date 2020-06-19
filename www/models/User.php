<?php 

namespace cms\models;

use cms\core\Helper;
use cms\managers\UserManager; 

class User extends Model
{
    protected $id;
    protected $login;
    protected $password;
    protected $email;
    protected $statut;
    protected $right;
    protected $identity = null;


    public function __Construct($id)
    {
        $user = new UserManager();
        $user->find($id);
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }

    public function setRight($right)
    {
        $this->right = $right;
    }

    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    
//GETTERS

    public function getId()
    {
        return $this->id;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getStatut(){
        return $this->statut;
    }

    public function getRight()
    {
        return $this->right;
    }

    public function getIdentity()
    {
        return $this->identity;
    }


}