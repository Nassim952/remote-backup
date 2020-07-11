<?php

namespace App\Core\Builder;


interface ElementPageBuilderInterface
{
    public function setType(string $type): self;

    public function getType(): string;

    public function setOptions(array $options): self;

    public function addComponent(Component $component): self;

    public function getComponents(): array;
}