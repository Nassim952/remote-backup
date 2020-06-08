<?php

namespace cms\Managers;

use cms\core\DB;

class UserManager extends DB{

    public function _construct(){
        parent::_construct(User::class,'users');
    }

    
    public function checkLogin()
    {
        $sql = "SELECT * FROM " . $this->table . ";";
        $queryPrepared = $this->connction->prepare($sql);
        $queryPrepared->execute();

        $result = $queryPrepared->fetchAll();

        foreach ($result as $value) {
            if ($value["login"] == $this->login && $value["password"] == $this->password) {
                session_start();
                $_SESSION['user'] = $value;
                return true;
            }
        }
    }

    public function getTypeUser()
    {
        if(isset($_SESSION))
        {
            $typeUser = $_SESSION['user']['type'];
            return $typeUser;
        }
    }

    public static function getTypeNameUser($typeUser = null)
    {
        if(null === $typeUser)
        {
            $typeUser = getTypeUser();
        }

        switch ($i) {
            case 1:
                return "Candidat";;
                break;
            case 2:
                return "Client";
                break;
            case 3:
                return "Editeur";
                break;
            case 4:
                return "Editeur d'utilisateur";
                break;
            case 5:
                return "Correcteur";
                break;
        }

    }

}