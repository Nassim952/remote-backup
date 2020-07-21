<?php

namespace cms\core\Builder;

use cms\models\Component;

interface PageBuilderInterface
{
    public function add(ElementPageBuilder $section): self;

    public function remove(int $position): self;

    public function getSections(): ?array;
}