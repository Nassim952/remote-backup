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
                    "required"=>true,
                    "placeholder"=>"Nom de la page",
                    "class"=>"input-form",
                    "id"=>"title",
                    "minlength"=>2,
                    "maxlength"=>200,
                    "errorMsg"=>"Le nom de la page doit faire entre 2 et 200 caractères"
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
                    ], 
                    "errorMsg"=>"error"
                ]);
    }
}
