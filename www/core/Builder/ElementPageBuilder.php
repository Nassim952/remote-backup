<?php

namespace cms\Core\Builder;

use cms\models\Component;
use cms\Core\Builder\ElementPageBuilderInterface;

class ElementPageBuilder implements ElementPageBuilderInterface
{
    private $components = [];

    private $size;

    private $page_id = null;

    private $position = null;

    public function __construct()
    {
        
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setPage(int $id)
    {
        $this->page_id = $id;
    }

    public function setSize(int $size)
    {
        $this->size = $size;
    }

    public function setPosition(array $position): ElementPageBuilder
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

    private function getSize(int $size)
    {
       return $this->size;
    }   
}