<?php

namespace www\core\connection;

Interface ResultInterface{

    public function fetchAll();
    public function fetchOne();
    public function fetch();
}