<?php

namespace cms\core\Connection;

Interface ResultInterface{

    public function getArrayResult();
    public function getOneOrNullResult();
    public function getValueResult();

}