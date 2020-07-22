<?php

namespace cms\forms;

use cms\core\Helpers;
use cms\core\Form;


class EditRoomType extends Form {
    
    public function initForm($datas)
    {
        foreach($datas['cinemas'] as $cinema) {
            $cinema_id = $cinema->getId();
            $cinema_name = $cinema->getName();
            $option_cinemas[$cinema_id] = $cinema_name;
        }
        
        return $this->builder
                ->add("id", "hidden", [
                    "attr"=>[
                        "id"=>"id",
                        "class"=>"input-form"
                    ],
                    "value"=>$datas['room'][0]->getId()   
                ])
                ->add("cinema_id", "select", [
                    "attr"=>[
                        "placeholder"=>"Cinema",
                        "id"=>"cinema_id",
                        "class"=>"input-form"
                    ],
                    "required"=>true,
                    "selected"=>$datas['room'][0]->getCinema_id(),
                    "options"=>$option_cinemas      
                ])
                ->add("name_room", "text", [
                    "attr"=>[
                        "placeholder"=>"Nom de la salle",
                        "id"=>"name_room",
                        "class"=>"input-form"
                    ],
                    "value"=>$datas['room'][0]->getName_room(),
                    "required"=>true
                ])
                ->add('nbr_places', 'number', [
                    'attr'=>[
                        'placeholder'=>'Nombre de places',
                        'id'=>'nbr_places',
                        'class'=>'input-form',
                        'min'=>'1'
                    ],
                    "value"=>$datas['room'][0]->getNbr_places(),
                    'required'=>true
                ])
                ->add('add-room', 'submit', [
                    'attr' => [
                        'value'=>'Modifier la salle',
                        'id'=>'add-room',
                        'class' => 'input-form submit-addfilm',
                    ]   
                ]);
                return $this;
    }

    public function configureOptions(): void
    {
        $this
            ->addConfig('class', User::class)
            ->setName('AddRoom')
            ->addConfig('attr', [
                "method" => "POST",
                "id"=>"formLoginUser",
                "class"=>"add-film",
            ]);
    }
}