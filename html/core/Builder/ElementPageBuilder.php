<?php

namespace cms\core\Builder;

use cms\models\Component;
use cms\core\Model;
use cms\core\Builder\ElementPageBuilderInterface;

class ElementPageBuilder extends Model
{
    private $id;

    private $components = [];

    private $size;

    private $page_id = null;

    private $position = null;

    public function initRelation(){
        return[

        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getPage_id()
    {
        return $this->page_id;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setPage_id(int $id)
    {
        $this->page_id = $id;
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function setPosition(int $position): ElementPageBuilder
    {
        $this->position = $position;

        return $this;
    }

    public function addComponent(Component $component): ElementPageBuilder
    {
        $component->setPosition(count($this->components));
        $component->setColumn($this->size);
        $this->components[] = $component;
        
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getComponents(): array
    {
        return $this->components;
    }

    public function getSize()
    {
        return $this->size;
    }   

    public function setComponents($components)
    {
        $this->components = $components;

        return $this;
    }

}