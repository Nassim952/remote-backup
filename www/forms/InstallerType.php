<?php

namespace cms\forms;

use cms\core\Helpers;
use cms\core\Constraints\Length;
use cms\core\Constraints\Password;
use cms\core\Form;

class InstallerType extends Form {

    public function initForm()
    {
        $this->builder
            ->add("dbhost", "text", [
                            "attr"=>
                            [
                            "placeholder"=>"Host DB",
                            "class"=>"form-control form-control-user"],
                            "required"=>true,
                            "label"=> "Hote"
                        ])
                        ->add( "dbname", "text", [
                            "attr"=>
                            [
                            "placeholder"=>"Name BDD",
                            "class"=>"form-control form-control-user"],
                            "required"=>true,
                            "label"=> "Database"
                         ])
                         ->add( "dbuser", "text", [
                            "attr"=>
                            [
                                "placeholder"=>"User DB Name",
                                "class"=>"form-control form-control-user"
                            ],
                            "required"=>true,
                            "label"=> "Utilisateur"
                         ])
                         ->add( "dbpassword", "password", [
                            "attr" => [
                                "placeholder"=>"Password DB",
                                "class"=>"form-control form-control-user",
                                "id"=>""
                             ],
                            "required"=>true,
                            "label"=>"Mot de passe",
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
            ->setName('Installer')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formLoginUser",
                "class"=>"user",
            ]);
    }
}