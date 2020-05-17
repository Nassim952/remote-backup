<?php

namespace www\core;

use www\core\DB;

class Model extends DB{

    public function _construct(){

        parent::_construct(get_called_class(),'user');
    
    }

    public function hydrade($data){
        array_walk(
            $data, function($key, $value){
                $method = 'set'.ucfirst($key);

                if(method_exists($this,$method))
                {   
                    $this->$methode($value);
                }
            }
        );
    }
}