<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class Room extends Model implements ModelInterface
{
    protected $id;
    protected $name_room;
    protected $cinema_id;
    protected $nbr_places;
    protected $section;
    
    public function initRelation(): array {
        return [
        
        ];
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setName_room(string $name_room){
        $this->name_room = $name_room;
        return $this;
    }

    public function setCinema_id(int $cinema_id){
        $this->cinema_id = $cinema_id;
        return $this;
    }

    public function setNbr_places(int $nbr_places){
        $this->nbr_places = $nbr_places;
        return $this;
    }

//GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName_room(){
        return $this->name_room;
    }

    public function getCinema_id(){
        return $this->cinema_id;
    }

    public function getNbr_places(){
        return $this->nbr_places;
    }

}