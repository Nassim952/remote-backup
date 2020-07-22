<?php

    namespace cms\forms;
    
    use cms\core\Form;
    
    class CustomType extends Form {
    
        public function initForm()
        {
            $this->builder
            ->add('font', 'select', [
                'attr'=>[
                    'placeholder'=>'font',
                    'id'=>'font',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    'Arial'=>'Arial', 
                    'Roboto'=>'Roboto', 
                    'Georgia'=>'Georgia', 
                    'Calibri'=>'Calibri'
                ],
            ])
            ->add('font_color', 'select', [
                'attr'=>[
                    'placeholder'=>'font_color',
                    'id'=>'font_color',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    'Black'=>'Black', 
                    'Lightgrey'=>'Lightgrey', 
                    'White'=>'White'
                ],
            ])
            ->add('font_size', 'select', [
                'attr'=>[
                    'placeholder'=>'font_size',
                    'id'=>'font_size',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    '10'=>'10', 
                    '12'=>'12', 
                    '14'=>'14'
                ],
            ])
            ->add('template', 'select', [
                'attr'=>[
                    'placeholder'=>'template',
                    'id'=>'template',
                    'class'=>'input-form'
                ],
                'required'=>true,
                'options'=>[
                    'front-cms'=>'White template',
                    'front-cms-bis'=>'Pink-template',  
                ],
            ])
            ->add('submit', 'submit', [
                'attr' => [
                "class" => "Button",
                ]
            ]);
                return $this;
        }
    
        public function configureOptions(): void
        {
            $this
                ->addConfig('class', Page::class)
                ->setName('Configuration')
                ->addConfig('attr', [
                    "method" => "POST",
                    "id"=>"formPageConfig",
                    "class"=>"form-config",
                    "enctype"=>"multipart/form-data"
                ]);
        }
    }
