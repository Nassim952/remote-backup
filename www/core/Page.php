<?php

namespace cms\core;

use cms\core\Model;
use cms\core\Builder\ElementPageBuilder;
use cms\core\Builder\PageBuilder;
use cms\models\Page as ModelsPage;

class Page extends Model
{
    protected $id;
    protected $builder;
    protected $title;
    protected $gabarit;
    protected $creation_date;
    protected $font;
    protected $font_color;
    protected $theme;

    public function __Construct()
    {
        $this->builder = new PageBuilder();
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function setPassword(string $type)
    {
        $this->type = $type;
    }

    public function setGabarit($gabarit)
    {
        $this->gabarit = $gabarit;
    }

    public function setDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    public function setBackground($background_image)
    {
        $this->background_image = $background_image;
    }

    public function setBuilder(PageBuilder $builder)
    {
        $this->builder = $builder;
    }
    

//GETTERS

    public function getId()
    {
       return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPassword()
    {
        return $this->type;
    }

    public function getGabarit()
    {
        return $this->gabarit;
    }

    public function getDate()
    {
        return $this->creation_date;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function getBackground()
    {
        return $this->background_image;
    }

//OPERATIONS


    /**
     * Get the value of font
     */ 
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set the value of font
     *
     * @returnself
     */ 
    public function setFont($font)
    {
        $this->font = $font;

        return $this;
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
}