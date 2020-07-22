<?php

namespace cms\forms;

use cms\core\Helpers;
use cms\core\Constraints\Length;
use cms\core\Constraints\Password;
use cms\core\Form;


class AddPageType extends Form {
    
    public function initForm()
    {
        return $this->builder
                ->add("title", "text", [
                    "attr"=>[
                        "placeholder"=>"Nom de la page",
                        "id"=>"title",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    'constraints' => [
                        new Length(2,50, 'Le nom de la page doit faire entre 2 et 200 caractères')
                    ]
                ])
                ->add("gabarit", "select", [
                    "attr"=>[
                        "placeholder"=>"Taille du contenu",
                        "id"=>"gabarit",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "options"=>[
                        1=>"1 row", 
                        2=>"2 row", 
                        3=>"3 row"
                    ]
                ])
                ->add('add-page', 'submit', [
                    'attr' => [
                        'value'=>'Ajouter la page',
                        'id'=>'add-page',
                        'class' => 'input-form submit-addfilm',
                    ]   
                ]);
                return $this;
    }

    public function configureOptions(): void
    {
        $this
            ->addConfig('class', User::class)
            ->setName('AddPage')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formLoginUser",
                "class"=>"add-film",
            ]);
    }
}
