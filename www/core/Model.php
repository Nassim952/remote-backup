<?php

namespace cms\core;

class Model implements \JsonSerializable{


    public function __toArray(): array
    {
        return get_object_vars($this);
    }

    public function toString(): array
    {

    }

    public function hydrate(array $data)
    {
        $relations = $this->initRelation();
        foreach ($data as $key => $value) {
            if ( array_key_exists($key,$relations)) {
                $class = $relations[$key];
                $value = (new $class($value));
            }
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function JsonSeralisable()
    {
        return $this->__toArray();
    }

}