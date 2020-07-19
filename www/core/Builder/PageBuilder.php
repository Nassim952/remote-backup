<?php

namespace cms\Core\Builder;

use cms\Core\Builder\ElementPageBuilder;
use cms\Core\Builder\PageBuilderInterface;

class PageBuilder implements PageBuilderInterface
{
    protected $sections = [];
    
    public function add(ElementPageBuilder $section): PageBuilderInterface
    {

        $this->sections[] = $section;    
     
        return $this;
    }

    public function setSections(array $sections)
    {
        $this->sections = $sections;
    }

    public function remove(int $position): PageBuilderInterface
    {
        new SectionManager()->delete(section[$position]);
        
        return $this;
    }

    public function getSection(int $position): ? ElementPageBuilder
    {
        return $this->sections[$position];
    }

    public function getSections(): ?array
    {
        return $this->sections;
    }
}