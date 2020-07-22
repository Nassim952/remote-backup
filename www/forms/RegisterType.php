<?php

namespace cms\forms;

use cms\core\Constraints\ConfirmPwd;
use cms\core\Form;
use cms\core\Constraints\Length;
use cms\core\Constraints\Password;
use cms\core\Helpers;

class RegisterType extends Form {

    public function initForm()
    {
            $this->builder
            ->add("firstname", "text", [
                "attr"=>
                [
                "placeholder"=>"Votre prénom",
                "class"=>"form-control form-control-user"],
                "required"=>true,
                'constraints' => [
                    new Length(2,50, 'Votre prénom doit contenir au moins 2 caractères', 'Votre prénom doit contenir au plus 50 caractères')
                ]
            ])
            ->add("lastname", "text", [
                "attr"=>
                [
                "placeholder"=>"Votre nom",
                "class"=>"form-control form-control-user"],
                "required"=>true,
                'constraints' => [
                    new Length(2,50, 'Votre prénom doit contenir au moins 2 caractères', 'Votre prénom doit contenir au plus 50 caractères')
                ]
            ])
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
            ->add( "pwdConfirm", "password", [
                "attr" => ["placeholder"=>"Confirmer mot de passe",
                    "class"=>"form-control form-control-user",
                    "id"=>""
                    ],
                    "required"=>true,
                    "constraints" => [
                        new ConfirmPwd($this->getName()),
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
            ->setName('Register')
            ->addConfig('attr', [
                "id"=>"formRegisterUser",
                "class"=>"user col-sm-4",
            ]);
    }
}