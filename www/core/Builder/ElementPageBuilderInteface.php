<?php

namespace cms\Core\Builder;

use cms\models\Component;

interface ElementPageBuilderInterface
{
    public function setType(string $type);

    public function getType(): string;

    public function addComponent(Component $component): self;

    public function getComponents(): array;
}