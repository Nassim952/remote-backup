<?php

namespace cms\forms;

use cms\forms;

use cms\core\Helpers;
use cms\core\Constraints\Length;
use cms\core\Constraints\Password;
use cms\core\Form;


class AddFilmType extends Form {
    
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
                ->add("content_size", "select", [
                    "attr"=>[
                        "placeholder"=>"Taille du contenu",
                        "id"=>"content_size",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "option"=>[
                        "col-1"=>"1 colonne", 
                        "col-2"=>"2 colonnes", 
                        "col-3"=>"3 colonnes", 
                        "col-4"=>"4 colonnes", 
                        "col-6"=>"6 colonnes",
                        "col-12"=>"12 colonnes"
                    ]
                ])
                ->add("background_color", "select", [
                    "attr"=>[
                        "placeholder"=>"Couleur du fond",
                        "id"=>"background_color",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "option"=>[
                        "blue"=>"Bleu", 
                        "red"=>"Rouge", 
                        "grey"=>"Gris", 
                        "white"=>"Blanc" 
                    ]
                ])
                ->add("font", "select", [
                    "attr"=>[
                        "placeholder"=>"Police d'écriture",
                        "id"=>"bg-color",
                        "class"=>"font"
                    ],
                    "required"=>true,
                    "option"=>[
                        "roboto"=>"Roboto", 
                        "raleway"=>"Raleway", 
                        "fondamento"=>"Fondamento"
                    ]
                ])
                ->add("font-color", "select", [
                    "attr"=>[
                        "placeholder"=>"Couleur de police",
                        "id"=>"bg-color",
                        "class"=>"font-color"
                    ],
                    "required"=>true,
                    "option"=>[
                        "blue"=>"Bleu", 
                        "red"=>"Rouge", 
                        "grey"=>"Gris", 
                        "white"=>"Blanc"
                    ]
                ]);
    }

    public function configureOptions(): void
    {
        $this
            ->addConfig('class', User::class)
            ->setName('AddPage')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formLoginUser",
                "class"=>"user",
            ]);
    }
}
