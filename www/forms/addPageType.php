<?php

namespace cms\forms;

use cms\forms;

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
                        "row"=>"1 row", 
                        "row-2"=>"2 row", 
                        "row-3"=>"3 row"
                    ]
                ])
                ->add("theme", "select", [
                    "attr"=>[
                        "placeholder"=>"Couleur du theme",
                        "id"=>"theme",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "options"=>[
                        "blue"=>"Bleu", 
                        "red"=>"Rouge", 
                        "grey"=>"Gris", 
                        "white"=>"Blanc" 
                    ]
                ])
                ->add("font", "select", [
                    "attr"=>[
                        "placeholder"=>"Police d'écriture",
                        "id"=>"font",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "options"=>[
                        "roboto"=>"Roboto", 
                        "raleway"=>"Raleway", 
                        "fondamento"=>"Fondamento"
                    ]
                ])
                ->add("font-color", "select", [
                    "attr"=>[
                        "placeholder"=>"Couleur de police",
                        "id"=>"font-color",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "options"=>[
                        "blue"=>"Bleu", 
                        "red"=>"Rouge", 
                        "grey"=>"Gris", 
                        "white"=>"Blanc"
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
