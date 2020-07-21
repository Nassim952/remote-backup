<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;
use cms\managers\ComponentManager;

class Component extends Model implements ModelInterface
{ 
    protected $id;
    protected $title;
    protected $categorie;
    protected $data = [];
    protected $position;

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

    public function setData($data)
    {
        $this->data = $data;
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

    public function getData()
    {
        return $this->data;
    }

    public function getStyle($style)
    {
        return $this->style;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }
}