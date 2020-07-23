<?php

namespace cms\forms;

use cms\core\Helpers;
use cms\core\Constraints\Length;
use cms\core\Constraints\Password;
use cms\core\Constraints\Captcha;
use cms\core\Form;
use cms\core\Constraints\ConfirmPwd;

class ResetPwdFormType extends Form {

    public function initForm()
    {
        $this->builder
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
                "class" => "Button",
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