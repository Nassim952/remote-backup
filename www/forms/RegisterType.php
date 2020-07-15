<?php

namespace cms\forms;

use cms\core\Form;
use cms\core\Helpers;

class RegisterType extends Form {

    public function initForm()
    {
        $this->builder
            ->add("firstname", "text", [
                            "placeholder"=>"Votre prénom",
                            "class"=>"form-control form-control-user",
                            "id"=>"",
                            "required"=>true,
                            "min-length"=>2,
                            "max-length"=>50,
                            "errorMsg"=>"Votre prénom doit faire entre 2 et 50 caractères",
                            "label"=>"Prenom"
                        ])
            ->add("lastname", "text", [
                "placeholder"=>"Votre nom",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "min-length"=>2,
                "max-length"=>100,
                "errorMsg"=>"Votre nom doit faire entre 2 et 100 caractères",
                "label"=>"nom"
            ])
            ->add("email", "email", [
                "placeholder"=>"Votre email",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "uniq"=>["table"=>"users","column"=>"email"],
                "errorMsg"=>"Le format de votre email ne correspond pas",
                "label"=>"Email"
            ])
            ->add( "pwd", "password", [
                "placeholder"=>"Votre mot de passe",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule et une majuscule",
                "label"=>"Mot de passe"
            ])
            ->add("pwdConfirm", "confirmPassword", [
                "placeholder"=>"Confirmation",
                "class"=>"form-control form-control-user",
                "id"=>"",
                "required"=>true,
                "confirmWith"=>"pwd",
                "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas",
                "label"=>"Confirmation de mot de passe"
            ])
            ->add('submit', 'submit', [
                'label' => 'S\'inscrire',
                'attr' => [
                    
                ]
            ]);

            return $this;
    }

    public static function getForm(){
        return [
                    "config"=>[
                        "method"=>"POST", 
                        "action"=>Helpers::getUrl("user", "signup"),
                        "class"=>"user",
                        "id"=>"form_inscription",
                        "submit"=>"S'inscrire"
                        ],

                    "fields"=>[
                        "firstname"=>[
                                "type"=>"text",
                                "placeholder"=>"Votre prénom",
                                "class"=>"form-control form-control-user",
                                "id"=>"",
                                "required"=>true,
                                "firstname-min-length"=>2,
                                "firstname-max-length"=>50,
                                "errorMsg"=>"Votre prénom doit faire entre 2 et 50 caractères"
                            ],
                        "lastname"=>[
                                "type"=>"text",
                                "placeholder"=>"Votre nom",
                                "class"=>"form-control form-control-user",
                                "id"=>"",
                                "required"=>true,
                                "lastname-min-length"=>2,
                                "lastname-max-length"=>100,
                                "errorMsg"=>"Votre nom doit faire entre 2 et 100 caractères"
                            ],
                        "email"=>[
                                "type"=>"email",
                                "placeholder"=>"Votre email",
                                "class"=>"form-control form-control-user",
                                "id"=>"",
                                "required"=>true,
                                "uniq"=>["table"=>"users","column"=>"email"],
                                "errorMsg"=>"Le format de votre email ne correspond pas"
                            ],
                        "password"=>[
                                "type"=>"password",
                                "placeholder"=>"Votre mot de passe",
                                "class"=>"form-control form-control-user",
                                "id"=>"",
                                "required"=>true,
                                "errorMsg"=>"Votre mot de passe doit faire entre 6 et 20 caractères avec une minuscule une majuscule et au moins un chiffre"
                            ],
                        "confirmpwd"=>[
                                "type"=>"password",
                                "placeholder"=>"Confirmation",
                                "class"=>"form-control form-control-user",
                                "id"=>"",
                                "required"=>true,
                                "confirmWith"=>"pwd",
                                "errorMsg"=>"Votre mot de passe de confirmation ne correspond pas"
                            ],
                        // "captcha"=>[
                        //         "type"=>"captcha",
                        //         "class"=>"form-control form-control-user",
                        //         "id"=>"",
                        //         "required"=>true,
                        //         "placeholder"=>"Veuillez saisir les caractères",
                        //         "errorMsg"=>"Captcha incorrect"
                        //     ]
                    ]
                ];
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