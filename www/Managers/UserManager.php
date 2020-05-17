<?php

namespace www\Managers;

use www\core\Model;

class UserManager extends Model{

public function _construct(){

    parent::_construct(get_called_class(),'user');

}

}