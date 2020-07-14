<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;
use cms\managers\PageManager;

class Page extends Model implements ModelInterface
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

    public function initRelation(): array {
        return [
        
        ];
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

    public function delete($id){
        $pageManager = new PageManager(Page::class, 'page');

        $pageManager->deletePage($id);
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

    public function getId(): ?int
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
}