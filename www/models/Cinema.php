<?php 

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class Cinema extends Model implements ModelInterface
{
    protected $id = null;
    protected $name;
    protected $place;
    protected $number_rooms;

    public function initRelation(): array {
        return [
        
        ];
    }

    /**
     * Get the value of id
     */ 
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of place
     */ 
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set the value of place
     *
     * @return  self
     */ 
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get the value of number_rooms
     */ 
    public function getNumber_rooms()
    {
        return $this->number_rooms;
    }

    /**
     * Set the value of number_rooms
     *
     * @return  self
     */ 
    public function setNumber_rooms($number_rooms)
    {
        $this->number_rooms = $number_rooms;

        return $this;
    }
}