<?php

namespace www\core;

class Model implements \JsonSerializable{

    public function toString(): array
    {


    }

    public function hydrade($data)
    {
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

    public function hydrate(array $data){
        foreach ($data as $key => $value){
            // permet de mettre une majuscule a la 1ere lettre de chaque clé (correspondance nom méthodes)
            $method = 'set'.ucfirst($key);
            
            if(method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }

    public function JsonSeralisable(){

       
    }

}