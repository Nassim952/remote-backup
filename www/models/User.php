<?php 

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class User extends Model implements ModelInterface
{
    protected $id = null;
    protected $lastname;
    protected $firstname;
    protected $password;
    protected $email;
    protected $statut;
    protected $allow;
    protected $token;

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

    public function setLastname($lastname)
    {
        $this->lastname = ucfirst($lastname);
    }

    public function setFirstname($firstname)
    {
        $this->firstname = ucfirst($firstname);
    }

    
//GETTERS

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Get the value of token
     */ 
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @returnself
     */ 
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}