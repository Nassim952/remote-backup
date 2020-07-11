<?php

namespace cms\forms;

use cms\core\Form;

class LoginType extends Form {

    public function getForm()
    {
        return $this->builder
            ->addField("firstname", "text", [
                'placeholder' => 'toto'
            ])
            ->addField( "pwd", "password", [
                "placeholder"=>"Votre mot de passe",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule"
            ]);
    }
}
