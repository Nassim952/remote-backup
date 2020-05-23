<?php

namespace www\core\Connection;

Interface ResultInterface{

    public function fetchAll();
    public function fetchOne();
    public function fetch();
}