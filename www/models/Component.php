<?php

namespace www\models;

use www\core\DB;

class Component extends DB
{ 
    protected $id;
    protected $title;
    protected $class;
    protected $type;
    protected $data = [];
    protected $position;
    protected $style;

    public function __Construct()
    {

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

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
       return $this->title;
    }

    public function getClass()
    {
        return $this->title;
    }

    public function getPassword($type)
    {
        return $this->type;
    }

    public function getStyle($style)
    {
        return $this->style;
    }
}