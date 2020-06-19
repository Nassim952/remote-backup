<?php

namespace www\forms;

use cms\core\Helper;

class RegisterType
{
    
    public static function getForm()
    {
        return $this->builder
            ->addField("firstname", "text", [
                "placeholder"=>"Votre prénom",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "min-length"=>2,
                "max-length"=>50,
                "errorMsg"=>"Votre prénom doit faire entre 2 et 50 caractères"
            ])
            ->addField("lastname", "text", [
                "placeholder"=>"Votre nom",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "min-length"=>2,
                "max-length"=>100,
                "errorMsg"=>"Votre nom doit faire entre 2 et 100 caractères"
            ])
            ->addField("email", "email", [
                "placeholder"=>"Votre email",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "uniq"=>["table"=>"users","column"=>"email"],
                "errorMsg"=>"Le format de votre email ne correspond pas"
            ])
            ->addField( "pwd", "password", [
                "placeholder"=>"Votre mot de passe",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule"
            ])
            ->addField("pwdConfirm", "password", [
                "placeholder"=>"Confirmation",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "confirmWith"=>"pwd",
                "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas"
            ]);
    }
}
