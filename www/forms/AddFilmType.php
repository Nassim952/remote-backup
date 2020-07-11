<?php

namespace cms\forms;

use cms\forms;

use cms\core\Form;
use cms\core\Helper;


class AddFilmType extends Form {
    
    public static function getForm()
    {
        return $this->builder
                ->addField("title", "text", [
                    "required"=>true,
                    "placeholder"=>"Titre du film",
                    "class"=>"input-form",
                    "id"=>"title",
                    "minlength"=>2,
                    "maxlength"=>100,
                    "errorMsg"=>"Votre titre doit faire entre 2 et 50 caractères"
                    ])
                ->addField("duration", "time", [
                    "placeholder"=>"Durée du film",
                    "class"=>"input-form",
                    "id"=>"duration",
                    "required"=>true,
                    "errorMsg"=>"Votre date est au mauvais format"
                ])
                ->addField("genre", "select", [
                    "placeholder"=>"Genre",
                    "class"=>"input-form",
                    "id"=>"genre",
                    "required"=>true,
                    "option"=>[
                        "action"=>"Action", 
                        "aventure"=>"Aventure", 
                        "horreur"=>"Horreur", 
                        "animation"=>"Animation", 
                        "comedie"=>"Comedie"
                    ], 
                    "errorMsg"=>"error"
                ])
                ->addField("age", "select", [
                    "placeholder"=>"Age",
                    "class"=>"input-form",
                    "id"=>"age",
                    "required"=>true,
                    "option"=>[
                        "-10"=>"-10", 
                        "-12"=>"-12", 
                        "-16"=>"-16", 
                        "-18"=>"-18"
                    ], 
                    "errorMsg"=>"error"
                ])
                ->addField("date", "date", [
                    "placeholder"=>"Date de sortie",
                    "class"=>"input-form",
                    "id"=>"date",
                    "required"=>true,
                    "errorMsg"=>"Votre date n'est pas au format JJ/MM/AAAA"
                ])
                ->addField("real", "text", [
                    "placeholder"=>"Réalisateur",
                    "class"=>"input-form",
                    "id"=>"real",
                    "required"=>true,
                    "min-length"=>1,
                    "max-length"=>100,
                    "errorMsg"=>"Le nom du réalisateur doit comporter entre 1 et 100 caractères"
                ])
                ->addField("actor", "text", [
                    "placeholder"=>"Acteur principal",
                    "class"=>"input-form",
                    "id"=>"actor",
                    "required"=>true,
                    "min-length"=>1,
                    "max-length"=>100,
                    "errorMsg"=>"Le nom de l'acteur doit comporter entre 1 et 100 caractères"
                ])
                ->addField("nationality", "select", [
                    "placeholder"=>"Nationalité",
                    "class"=>"input-form",
                    "id"=>"nationality",
                    "required"=>true,
                    "option"=>[
                        "fr"=>"France", 
                        "usa"=>"Etat-Unis", 
                        "es"=>"Espagne"
                    ],
                    "errorMsg"=>"error"
                ])
                ->addField("poster", "url", [
                    "type"=>"url",
                    "placeholder"=>"Affiche du film",
                    "class"=>"input-form",
                    "id"=>"poster",
                    "required"=>true,
                    "errorMsg"=>"error file"
                ]);
        }
    }
}
