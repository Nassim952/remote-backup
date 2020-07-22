<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;
use cms\managers\ComponentManager;

class Component extends Model implements ModelInterface
{ 
    protected $id;
    protected $categorie;
    protected $position;
    protected $section_id;

    public function initRelation(): array {
        return [
        
        ];
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

    public function setColumn(int $column)
    {
        $this->column = $column;
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

//GETTERS

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle()	
    {
        return $this->title;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function getStyle($style)
    {
        return $this->style;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Get the value of section_id
     */ 
    public function getSection_id()
    {
        return $this->section_id;
    }

    /**
     * Set the value of section_id
     *
     * @returnself
     */ 
    public function setSection_id($section_id)
    {
        $this->section_id = $section_id;

        return $this;
    }
}