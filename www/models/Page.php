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
    protected $gabarit;
    protected $creation_date;
    protected $theme;
    protected $font;
    protected $font_color;

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
        $this->font_color = $font_color;
    }

//GETTERS

    public function getId(): ?int
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
    
    public function getFont(){
        return $this->font;
    }

    public function getFontColor(){
        return $this->font_color;
    }
}