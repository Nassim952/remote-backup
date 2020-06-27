<?php

namespace cms\core;

interface ModelInterface

{
    public function getId(): ?int;

    public function setId(int $id);

    public function initRelation(): array;
}
