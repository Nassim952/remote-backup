<?php

namespace www\core\connection;

interface BDDInterface{

    public function query();
    public function connect(string $query, array $parameters = null);

}