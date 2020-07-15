<?php

namespace cms\models;

use cms\core\Model;

class Page extends Model
{
    protected $builder;
    protected $id = null;
    protected $title;
    protected $type;
    protected $gabarit;
    protected $section = [];
    protected $creation_date;
    protected $theme;
    protected $background_image;

    public function __Construct()
    {

    }

    public function associateValue()
    {
        foreach($this->builder->getElements() as $key => $element)
        {
            $method = 'get'.ucfirst($key);

            if(method_exists($this->model, $method))
            {
                $this->builder->setValue($key, $this->model->$method());
            }
        }
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle(string $title){
        $this->title = $title;
    }

    public function setGabarit($gabarit){
        $this->gabarit = $gabarit;
    }

    public function setCreationDate($creation_date){
        $this->creation_date = $creation_date;
    }

    public function setTheme($theme){
        $this->theme = $theme;
    }
    
    public function setFont($font){
        $this->font = $font;
    }

    public function setFontColor($font_color){
        $this->font = $font_color;
    }

//GETTERS

    public function getId()
    {
       return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getGabarit(){
        return $this->gabarit;
    }

    public function getDate(){
        return $this->creation_date;
    }

    public function getTheme(){
        return $this->theme;
    }

    public function getBackground(){
        return $this->background_image;
    }
    
    public function getFont(){
        return $this->font;
    }

    public function getFontColor(){
        return $this->font;
    }

    public function getContentSize(){
        return $this->content_size;
    }
}