<?php

namespace www\models;

use www\core\Model;

class Movie extends Model
{ 
    protected $id;
    protected $title;
    protected $release;
    protected $duration;
    protected $synopsis;

    public function __Construct($id)
    {
        $movie = new MovieManager();
        $movie->find($id);    
    }

//SETTERS

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setRelease($release)
    {
        $this->release = $release;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
    }

//GETTERS

    public function getId()
    {
    return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getRelease($release)
    {
        return $this->release;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function getSynopsis()
    {
        return $this->synopsis;
    }


}