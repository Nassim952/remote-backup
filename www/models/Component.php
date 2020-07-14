<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class Component extends Model implements ModelInterface
{ 
    protected $id;
    protected $title;
    protected $class;
    protected $type;
    protected $data = [];
    protected $position;
    protected $style;

    public function initRelation(): array {
        return [
        
        ];
    }

    //SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setClass($class)
    {
        $this->title = $class;
    }

    public function setPosition($type)
    {
        $this->type = $type;
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function setData($data)
    {
        $this->data = $data;
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

    public function getPassword($type)
    {
        return $this->type;
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
}