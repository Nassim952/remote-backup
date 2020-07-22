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
                            "class"=>"input-form"],
                            "required"=>true,
                            "label"=> "Hote"
                        ])
                        ->add( "dbname", "text", [
                            "attr"=>
                            [
                            "placeholder"=>"Name BDD",
                            "class"=>"input-form"],
                            "required"=>true,
                            "label"=> "Database"
                         ])
                         ->add( "dbuser", "text", [
                            "attr"=>
                            [
                                "placeholder"=>"User DB Name",
                                "class"=>"input-form"
                            ],
                            "required"=>true,
                            "label"=> "Utilisateur"
                         ])
                         ->add( "dbpassword", "password", [
                            "attr" => [
                                "placeholder"=>"Password DB",
                                "class"=>"input-form",
                                "id"=>""
                             ],
                            "required"=>true,
                            "label"=>"Mot de passe",
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
            ->setName('Installer')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formLoginUser",
                "class"=>"user",
            ]);
    }
}