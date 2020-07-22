<?php

    namespace cms\forms;
    
    use cms\core\Helpers;
    use cms\core\Constraints\Length;
    use cms\core\Constraints\Password;
    use cms\core\Form;
    use cms\models\Cinema;
    use cms\managers\CinemaManager;
    
    class AddSeanceType extends Form {
    
        public function initForm($datas)
        {
            $cinemaManager = new cinemaManager();

            foreach($datas['salles'] as $salle) {
                $cinema_id = $salle->getCinema_id();
                $cinema_name = $cinemaManager->readName($cinema_id);
                $room_name = $salle->getName_room();
                $room_id = $salle->getId();
                $option_rooms[$room_id] = $cinema_name . ' : ' . $room_name;
            }

            foreach($datas['movies'] as $movie) {
                $movie_id = $movie->getId();
                $movie_name = $movie->getTitle();
                $option_movies[$movie_id] = $movie_name;
            }

            $this->builder
            ->add('movie', 'select', [
                'attr'=>[
                    'placeholder'=>'Titre du film',
                    'id'=>'movie',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>$option_movies
            ])
            ->add('room', 'select', [
                'attr'=>[
                    'placeholder'=>'Cinéma : Salles',
                    'id'=>'room',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>$option_rooms
            ])
            ->add('date', 'datetime-local', [
                'attr'=>[
                    'id'=>'datetime',
                    'min'=>date("Y-m-d\T00:00:00"),
                    'class'=>'input-form datetime'
                ]
            ])
            ->add('add-film', 'submit', [
                'attr' => [
                    'value'=>'Ajouter la séance',
                    'id'=>'add-film',
                    'class' => 'input-form submit-addfilm',
                ]
            ]);
                return $this;
        }
    
        public function configureOptions(): void
        {
            $this
                ->addConfig('class', User::class)
                ->setName('Seance')
                ->addConfig('attr', [
                    "method" => "POST",
                    "id"=>"formLoginUser",
                    "class"=>"add-film",
                    "enctype"=>"multipart/form-data"
                ]);
        }
    }
