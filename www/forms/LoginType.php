<?php

namespace cms\forms;

use cms\core\Helpers;
use cms\core\Constraints\Length;
use cms\core\Constraints\Password;
use cms\core\Form;

class LoginType extends Form {

    public function initForm()
    {
        $this->builder
            ->add("email", "email", [
                            "attr"=>
                            [
                            "placeholder"=>"email",
                            "class"=>"form-control form-control-user"],
                            "required"=>true,
                            'constraints' => [
                                new Length(2,50, 'Votre prénom doit contenir au moins 2 caractères', 'Votre prénom doit contenir au plus 50 caractères')
                            ]
                        ])
                        ->add( "password", "password", [
                            "attr" => ["placeholder"=>"Mot de passe",
                             "class"=>"form-control form-control-user",
                             "id"=>""
                             ],
                             "required"=>true,
                             "constraints" => [
                                new Password(),
                             ]
                         ])
                        ->add('submit', 'submit', [
                            'attr' => [
                            "class" => "button",
                            ]
                        ]);
            return $this;
    }

    public function configureOptions(): void
    {
        $this
            ->addConfig('class', User::class)
            ->setName('Login')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formLoginUser",
                "class"=>"user",
            ]);
    }
}