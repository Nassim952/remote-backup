<?php

namespace App\Core\Builder;

class PageBuilder implements ElementFormBuilderInterface
{
    private $sections = [];

    public function add(string $type = "text"): PageBuilderInterface
    {
        $this->sections[] = 
            (new ElementPageBuilder())
                ->setName($name)
                ->setType($type)
                ->setPosition(count($this->sections));
     
        return $this;
    }

    public function remove(int $position): PageBuilderInterface
    {
        unset($this->elements[$position]);

        return $this;
    }

    public function getSection(int $position): ?ElementPageBuilder
    {
        return $this->sections[$position];
    }

    public function getSections(): ?array
    {
        return $this->sections;
    }
}