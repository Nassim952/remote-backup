<?php

namespace www\Managers;

use www\core\DB;

class UserManager extends DB{

    public function _construct(){
        parent::_construct(User::class,'users');
    }

    
    public function checkLogin()
    {
        $sql = "SELECT * FROM " . $this->table . ";";
        $queryPrepared = $this->pdo->prepare($sql);
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

    public static function getTypeNameUser($typeUser){
        if ($typeUser == 1) {
            return "Candidat";
        }elseif ($typeUser == 2) {
            return "Client";
        }elseif ($typeUser == 3) {
            return "Editeur";
        }elseif($typeUser == 4){
            return "Editeur d'utilisateur";
        }elseif($typeUser == 5){
            return "Correcteur";
        }
    }

    public static function getRegisterForm(){
        return [
                    "config"=>[
                                "method"=>"POST", 
                                "action"=>\mvc\core\Helpers::getUrl("User", "register"),
                                "class"=>"",
                                "id"=>"",
                                "submit"=>"S'inscrire"
                            ],
                    "fields"=>[
                                "firstname"=>[
                                                "type"=>"text",
                                                "required"=>true,
                                                "placeholder"=>"Votre prénom",
                                                "class"=>"",
                                                "id"=>""
                                            ],
                                "lastname"=>[
                                                "type"=>"text",
                                                "required"=>true,
                                                "placeholder"=>"Votre nom",
                                                "class"=>"",
                                                "id"=>""
                                            ],
                                "email"=>[
                                                "type"=>"email",
                                                "required"=>true,
                                                "placeholder"=>"Votre email",
                                                "class"=>"",
                                                "id"=>""
                                            ],
                                "password"=>[
                                                "type"=>"password",
                                                "required"=>true,
                                                "placeholder"=>"Votre mot de passe",
                                                "class"=>"",
                                                "id"=>""
                                            ],
                                "passwordConfirm"=>[
                                                "type"=>"password",
                                                "required"=>true,
                                                "placeholder"=>"Confirmer le mot de passe",
                                                "class"=>"",
                                                "id"=>"",
                                                "confirmWith"=>"password"
                                            ],
                                "captcha"=>[
                                                "type"=>"captcha",
                                                "required"=>true,
                                                "placeholder"=>"Saisir le texte",
                                                "class"=>"",
                                                "id"=>""
                                            ]
                            ]
                ];
    }


}