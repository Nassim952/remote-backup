<?php

namespace cms\models;

use cms\core\DB;

class User extends DB{
    protected $login;
    protected $password;
    protected $type;

    public function __Construct(){
        parent::__construct();
    }

    public function setLogin($login){
        $this->login = $login;
    }

    public function setPassword($password){
        $this->password = $password;
    }
}