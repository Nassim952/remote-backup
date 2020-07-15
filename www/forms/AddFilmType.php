<?php

    namespace cms\forms;
    
    use cms\core\Helpers;
    use cms\core\Constraints\Length;
    use cms\core\Constraints\Password;
    use cms\core\Form;
    
    class AddFilmType extends Form {
    
        public function initForm()
        {
            $this->builder
            ->add('title', 'text', [
                'attr'=>[
                    'placeholder'=>'Titre du film',
                    'id'=>'title',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'constraints' => [
                    new Length(2,100, 'Votre titre doit contenir au moins 2 caractères', 'Votre titre doit contenir au plus 50 caractères')
                ]
            ])
            ->add('duration', 'time', [
                'attr'=>[
                    'placeholder'=>'Durée du film',
                    'id'=>'duration',
                    'class'=>'input-form'
                ],
                'required'=>true,
            ])
            ->add('kind', 'select', [
                'attr'=>[
                    'placeholder'=>'Genre',
                    'id'=>'genre',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    'action'=>'Action', 
                    'aventure'=>'Aventure', 
                    'horreur'=>'Horreur', 
                    'animation'=>'Animation', 
                    'comedie'=>'Comedie'
                ],
            ])
            ->add('age', 'select', [
                'attr'=>[
                    'placeholder'=>'Age',
                    'id'=>'age',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    '-10'=>'-10', 
                    '-12'=>'-12', 
                    '-16'=>'-16', 
                    '-18'=>'-18'
                ],
            ])
            ->add('date', 'date', [
                'attr'=>[
                    'placeholder'=>'Date de sortie du film',
                    'id'=>'date',
                    'class'=>'input-form'
                ],
                'required'=>true,
            ])
            ->add('director', 'text', [
                'attr'=>[
                    'placeholder'=>'Réalisateur',
                    'id'=>'director',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'constraints' => [
                    new Length(2,100, 'Le nom du réalisateur doit contenir au moins 2 caractères', 'Le nom du réalisateur doit contenir au plus 50 caractères')
                ]
            ])
            ->add('actor', 'text', [
                'attr'=>[
                    'placeholder'=>'Acteur principal',
                    'id'=>'actor',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'constraints' => [
                    new Length(2,100, "Le nom de l'acteur doit contenir au moins 2 caractères", "Le nom de l'acteur doit contenir au plus 50 caractères")
                ]
            ])
            ->add('nationality', 'select', [
                'attr'=>[
                    'placeholder'=>'Nationalité',
                    'id'=>'nationality',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    'fr'=>'France', 
                    'usa'=>'Etat-Unis', 
                    'es'=>'Espagne'
                ],
            ])
            ->add('type', 'select', [
                'attr'=>[
                    'placeholder'=>'Type',
                    'id'=>'type',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    'lm'=>'Long metrage', 
                    'cm'=>'Court metrage'
                ],
            ])
            ->add('image_url', 'url', [
                'attr'=>[
                    'placeholder'=>'Affiche du film',
                    'id'=>'image_url',
                    'class'=>'input-form'
                ],
                'required'=>true,
            ])
            ->add('synopsis', 'textarea', [
                'attr'=>[
                    'placeholder'=>'Synopsis',
                    'id'=>'synopsis',
                    'class'=>'input-form',
                    'rows'=>'600'
                ],
                'required'=>true,
            ])
            ->add('add-film', 'submit', [
                'attr' => [
                    'value'=>'Ajouter le film',
                    'id'=>'add-film',
                    'class' => 'button',
                ]
            ]);
                return $this;
        }
    
        public function configureOptions(): void
        {
            $this
                ->addConfig('class', User::class)
                ->setName('AddFilm')
                ->addConfig('attr', [
                    "method" => "POST",
                    "id"=>"formLoginUser",
                    "class"=>"user",
                ]);
        }
    }
