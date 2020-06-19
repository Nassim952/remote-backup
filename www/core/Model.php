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

    // public function hydrate(array $data)
    // {
    //     $relations = $this->initRelation();
    //     foreach ($data as $key => $value) {
    //         if ( array_key_exists($key,$relations)) {
    //             $class = $relations[$key];
    //             $value = (new $class($value));
    //         }
    //         $method = 'set'.ucfirst($key);

    //         if (method_exists($this, $method)) {
    //             $this->$method($value);
    //         }
    //     }
    // }

    public function hydrate(array $row)
    {
        $className = get_class($this);// $className = static::class
        $articleObj = new $className();
        foreach ($row as $key => $value) {
          
            $method = 'set'.ucFirst($key);
            if (method_exists($articleObj, $method)) {
                // Author = 4
                if($relation = $articleObj->getRelation($key)) {
                    // relation = User::class (App\Model\User)
                    $tmp = new $relation();
                    $tmp = $tmp->hydrate($row);
                    // Maintenant on récupère notre id qui est ... la valeur actuelle de notre objet
                    $tmp->setId($value);
                    $articleObj->$method($tmp);
                } else {
                    $articleObj->$method($value);
                }
            }
        }

        return $articleObj;
    }

    public function getRelation(string $key): ?string
    {
        $relations = $this->initRelation();

        if (isset($relations[$key])) {
            return $this->initRelation()[$key];
        }
            
        return null;
    }

    public function JsonSeralisable()
    {
        return $this->__toArray();
    }

}