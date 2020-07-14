<?php

namespace cms\core\Constraints;

interface ConstraintInterface
{
    public function isValid(string $value): bool;

    public function getErrors(): array;
}