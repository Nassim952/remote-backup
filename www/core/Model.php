<?php

namespace cms\core;

use ReflectionMethod;
use ReflectionProperty;

class Model extends DB implements \JsonSerializable
{

    public function __construct()
    {
        $this->readAnnotation();
    }
    public function __toArray(): array
    {
        return get_object_vars($this);
    }

    // Il est possible ici de remplacer l'objet courant par $this si vous le souhaitez
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

    public function jsonSerialize() {

        return $this->__toArray();
    }


    public function getRelation(string $key): ?string
    {
        $relations = $this->initRelation();

        if(isset($relations[$key]))
            return $this->initRelation()[$key];

        return null;
    }

    public function readAnnotation()
    {
    
        $properties = get_class_vars(static::class);
        $relation = [];

        foreach($properties as $property => $value)
        {
            $methodReflection = new ReflectionProperty($this,$property);
            $comment = $methodReflection->getDocComment();
        // echo $comment;
        }
    }

}
