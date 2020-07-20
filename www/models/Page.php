<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;
use cms\core\Builder\PageBuilder;
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


    public function __construct(){
        $this->builder = new PageBuilder();
    }
    
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


    public function setTheme($theme){
        $this->theme = $theme;
    }
    
    public function setFont($font){
        $this->font = $font;
    }

    public function setBuilder(PageBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function setSections(array $sections)
    {
        $this->builder->setSections($sections);
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

    public function getSections()
    {
        return $this->builder->getSections();
    }

    /**
     * Get the value of font_color
     */ 
    public function getFont_color()
    {
        return $this->font_color;
    }

    /**
     * Set the value of font_color
     *
     * @returnself
     */ 
    public function setFont_color($font_color)
    {
        $this->font_color = $font_color;

        return $this;
    }

    /**
     * Get the value of creation_date
     */ 
    public function getCreation_date()
    {
        return $this->creation_date;
    }

    /**
     * Set the value of creation_date
     *
     * @returnself
     */ 
    public function setCreation_date($creation_date)
    {
        $this->creation_date = $creation_date;

        return $this;
    }
}