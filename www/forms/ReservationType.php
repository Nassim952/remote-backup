<?php

    namespace cms\forms;
    
    use cms\core\Helpers;
    use cms\core\Constraints\Length;
    use cms\core\Constraints\Password;
    use cms\core\Form;
    
    class ReservationType extends Form {
    
        public function initForm($maxticket)
        {
            $this->builder
            ->add('nbr_ticket', 'number', [
                'attr'=>[
                    'placeholder'=>'Nombre de ticket',
                    'id'=>'nbr_ticket',
                    'class'=>'input-form',
                    'min'=>'1',
                    'max'=> $maxticket
                ],
                'required'=>true
            ])
            ->add("email", "email", [
                "attr"=>[
                    "placeholder"=>"email",
                    "class"=>"input-form"
                ],
                "required"=>true
            ])
            ->add('valid_reservation', 'submit', [
                'attr' => [
                    'value'=>'Valider la réservation',
                    'id'=>'valid_reservation',
                    'class' => 'input-form submit-addfilm',
                ]
            ]);
                return $this;
        }
    
        public function configureOptions(): void
        {
            $this
                ->addConfig('class', User::class)
                ->setName('Reservation')
                ->addConfig('attr', [
                    "method" => "POST",
                    "id"=>"formLoginUser",
                    "class"=>"add-film"
                ]);
        }
    
    }
