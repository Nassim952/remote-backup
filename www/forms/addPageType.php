<?php

namespace cms\forms;

use cms\forms;

use cms\core\Form;
use cms\core\Helper;


class AddFilmType extends Form {
    
    public static function initForm()
    {
        return $this->builder
                ->add("name", "text", [
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
                ->add("content", "select", [
                    "placeholder"=>"Taille du contenu",
                    "class"=>"input-form",
                    "id"=>"content",
                    "required"=>true,
                    "option"=>[
                        "col-1"=>"1 colonne", 
                        "col-2"=>"2 colonnes", 
                        "col-3"=>"3 colonnes", 
                        "col-4"=>"4 colonnes", 
                        "col-6"=>"6 colonnes",
                        "col-12"=>"12 colonnes"
                    ], 
                    "errorMsg"=>"error"
                ])
                ->add("content", "select", [
                    "attr"=>[
                        "placeholder"=>"Taille du contenu",
                        "id"=>"content",
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
                ->add("bg-color", "select", [
                    "placeholder"=>"Couleur du fond",
                    "class"=>"input-form",
                    "id"=>"bg-color",
                    "required"=>true,
                    "option"=>[
                        "blue"=>"Bleu", 
                        "red"=>"Rouge", 
                        "grey"=>"Gris", 
                        "white"=>"Blanc" 
                    ], 
                    "errorMsg"=>"error"
                ])
                ->add("font", "select", [
                    "placeholder"=>"Police d'écriture",
                    "class"=>"input-form",
                    "id"=>"font",
                    "required"=>true,
                    "option"=>[
                        "roboto"=>"Roboto", 
                        "raleway"=>"Raleway", 
                        "fondamento"=>"Fondamento"
                    ], 
                    "errorMsg"=>"error"
                ])
                ->add("font-color", "select", [
                    "placeholder"=>"Couleur de police",
                    "class"=>"input-form",
                    "id"=>"font-color",
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
            ->addConfig('class', Page::class)
            ->setName('AddPage')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formAddPage",
                "class"=>"page",
            ]);
    }
}
