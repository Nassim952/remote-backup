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
    protected $verified = 0;
    protected $email;
    protected $statut;
    protected $allow;
    protected $image_profile;
    protected $token;
    protected $report;

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

    public function setVerified($verified)
    {
        $this->verified = $verified;
    }

    public function setToken($token)
    {
         $this->token = $token;
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

    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * Get the value of image_profile
     */ 
    public function getImage_profile()
    {
        return $this->image_profile;
    }

    /**
     * Set the value of image_profile
     *
     * @returnself
     */ 
    public function setImage_profile($image_profile)
    {
        $this->image_profile = $image_profile;

        return $this;
    }

    /**
     * Get the value of report
     */ 
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set the value of report
     *
     * @returnself
     */ 
    public function setReport($report)
    {
        $this->report = $report;

        return $this;
    }
}