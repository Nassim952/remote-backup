<?php

namespace www\core\Connection;

interface BDDInterface{

    public function query();
    public function connect(string $query, array $parameters = null);

}