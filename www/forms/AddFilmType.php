<?php

    namespace cms\forms;
    
    use cms\core\Helpers;
    use cms\core\Constraints\Length;
use cms\core\Constraints\NoSpecialChar;
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
                    new Length(2,100, 'Votre titre doit contenir au moins 2 caractères', 'Votre titre doit contenir au plus 50 caractères'),
                    new NoSpecialChar()
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
                    'Action'=>'Action', 
                    'Aventure'=>'Aventure', 
                    'Horreur'=>'Horreur', 
                    'Animation'=>'Animation', 
                    'Comedie'=>'Comedie'
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
                    new Length(2,100, 'Le nom du réalisateur doit contenir au moins 2 caractères', 'Le nom du réalisateur doit contenir au plus 50 caractères'),
                    new NoSpecialChar()
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
                    new Length(2,100, "Le nom de l'acteur doit contenir au moins 2 caractères", "Le nom de l'acteur doit contenir au plus 50 caractères"),
                    new NoSpecialChar()
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
                    'France'=>'France', 
                    'Etats-Unis'=>'Etat-Unis', 
                    'Espagne'=>'Espagne',
                    'Japon'=>'Japon'
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
                    'long-metrage'=>'Long metrage', 
                    'court-metrage'=>'Court metrage'
                ],
            ])
            ->add('image', 'file', [
                'attr'=>[
                    'id'=>'image',
                    'class'=>'input-form',
                    'accept'=>'image/png, image/jpeg'
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
                    'class' => 'input-form submit-addfilm',
                ]
            ]);
                return $this;
        }
    
        public function configureOptions(): void
        {
            $this
                ->addConfig('class', User::class)
                ->setName('Movie')
                ->addConfig('attr', [
                    "method" => "POST",
                    "id"=>"formLoginUser",
                    "class"=>"add-film",
                    "enctype"=>"multipart/form-data"
                ]);
        }
    }
