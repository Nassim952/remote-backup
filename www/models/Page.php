<?php

namespace www\models;

use www\core\Model;

class Page extends Model
{
    protected $id;
    protected $builder;
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

    public function setPassword(string $type){
        $this->type = $type;
    }

    public function setGabarit($gabarit){
        $this->gabarit = $gabarit;
    }

    public function setDate($creation_date){
        $this->creation_date = $creation_date;
    }

    public function setTheme($theme){
        $this->theme = $theme;
    }

    public function setBackground($background_image){
        $this->background_image = $background_image;
    }

//GETTERS

    public function getId()
    {
       return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getPassword(){
        return $this->type;
    }

    public function getGabarit(){
        return $this->gabarit = $gabarit;
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
}