<?php 
class user extends DB{

    protected $id=null;
    protected $firstname;
    protected $lastname;
    protected $login;
    protected $password;
    protected $type;

    public function __Construct(){
        parent::__construct();
    }

    public function hydrade($data){
        array_walk($data, function($key, $value){
            if(isset($data[$key])){
                'set'.$key($value);
            }   
        });
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
}