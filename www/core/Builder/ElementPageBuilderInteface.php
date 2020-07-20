<!-- ON L'UTILISAIT MAIS CA BUG DU COUP ON ENLEVE (logique) -->

<?php

namespace cms\core\Builder;

use cms\models\Component;

interface ElementPageBuilderInterface
{
    public function setType(string $type);

    public function getType(): string;

    public function addComponent(Component $component): self;

    public function getComponents(): array;
}