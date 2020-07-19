<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class MovieReservation extends Model implements ModelInterface
{
    protected $id;
    protected $movie_session_id;
    protected $user_email;
    protected $nbr_places;

    
    public function initRelation(): array {
        return [
            
        ];
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setMovie_session_id(string $movie_session_id){
        $this->movie_session_id = $movie_session_id;
    }

    public function setUser_email(string $user_email){
        $this->user_email = $user_email;
    }

    public function setNbr_places(string $nbr_places){
        $this->nbr_places = $nbr_places;
    }

//GETTERS
    public function getId(): ?int
    {
    return $this->id;
    }

    public function getMovie_session_id(){
        return $this->movie_session_id;
    }

    public function getUser_email(){
        return $this->user_email;
    }

    public function getNbr_places(){
        return $this->nbr_places;
    }

}