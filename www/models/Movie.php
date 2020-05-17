<?php

namespace cms\models;

use cms\core\DB;

class Movie extends DB{ 
    protected $title;
    protected $release;
    protected $duration;
    protected $synopsis;

    public function __Construct(){
        parent::__construct();
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setRelease($release){
        $this->release = $release;
    }

    public function setDuration($duration){
        $this->duration = $duration;
    }

    public function setSynopsis($synopsis){
        $this->synopsis = $synopsis;
    }


    public function getTitle(){
        return $this->title;
    }

    public function getRelease($release){
        return $this->release;
    }

    public function getDuration(){
        return $this->duration;
    }

    public function getSynopsis(){
        return $this->synopsis;
    }


}