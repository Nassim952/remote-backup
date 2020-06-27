<?php 

namespace cms\models;

use cms\core\Helpers;
use cms\core\Model;
use cms\core\ModelInterface;
use cms\core\DB;

class User extends Model implements ModelInterface
{
    protected $id = null;
    protected $login;
    protected $password;
    protected $email;
    protected $statut;
    protected $allow;
    protected $identity_id = null;

    public function initRelation(): array {
        return [
        
        ];
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
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

    public function setAllow($allow)
    {
        $this->allow = $allow;
    }

    public function setIdentity($identity_id)
    {
        $this->identity_id = $identity_id;
    }

    
//GETTERS

    public function getId(): ?int
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

    public function getAllow()
    {
        return $this->allow;
    }

    public function getIdentity()
    {
        return $this->identity;
    }
}