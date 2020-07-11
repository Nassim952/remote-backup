<?php

namespace App\Core\Builder;


interface PageBuilderInterface
{
    public function add(Component $component): self;

    public function remove(int $position): self;

    public function getSections(): ?array;
}