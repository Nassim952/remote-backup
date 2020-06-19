<?php

namespace App\Core\Builder;

class ElementFormBuilder implements ElementPageBuilderInterface
{
    private $components = [];

    private $size;

    private $class;

    private $page_id = null;

    private $position = null;

    private $type;

    public function __construct(int $id)
    {
        $gabarit = parent::_construct(Gabarit::class,'gabarit');
        $gabarit->find($id);
    }

    public function setType(string $type): ElementPageBuilder
    {
        $this->type = $type;
    }

    private function setSize(int $size)
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