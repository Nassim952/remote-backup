<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class Movie extends Model implements ModelInterface
{ 
    protected $id = null;
    protected $title;
    protected $release_date;
    protected $duration;
    protected $synopsis;

    public function initRelation(): array {
        return [
            
        ];
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

    public function setRelease($release_date)
    {
        $this->release_date = $release_date;
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

    public function getId(): ?int
    {
    return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getRelease()
    {
        return $this->release_date;
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