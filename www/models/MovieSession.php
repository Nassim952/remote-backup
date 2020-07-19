<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class MovieSession extends Model implements ModelInterface
{
    protected $id;
    protected $date_screaning;
    protected $movie_id;
    protected $room_id;
    protected $nbr_place_rest;
    
    public function initRelation(): array {
        return [
            
        ];
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setDate_screaning(string $date_screaning){
        $this->date_screaning = $date_screaning;
    }

    public function setMovie(string $movie){
        $this->movie_id = $movie;
    }

    public function setRoom(string $room){
        $this->room_id = $room;
    }

    public function setNbr_place_rest(string $nbr_place_rest){
        $this->nbr_place_rest = $nbr_place_rest;
    }

//GETTERS
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate_screaning(){
        return $this->date_screaning;
    }

    public function getMovie(){
        return $this->movie_id;
    }

    public function getRoom(){
        return $this->room_id;
    }

    public function getNbr_place_rest(){
        return $this->nbr_place_rest;
    }

}