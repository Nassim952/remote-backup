<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;
use cms\managers\MovieManager;

class Movie extends Model implements ModelInterface
{ 
    protected $id = null;
    protected $title;
    protected $release_date;
    protected $duration;
    protected $synopsis;
    protected $kind;
    protected $age_require;
    protected $director;
    protected $main_actor;
    protected $nationality;
    protected $movie_type;
    protected $image_poster;

    public function initRelation(): array {
        return [
            
        ];
    }

    public function delete($id){
        $movieManager = new MovieManager(Movie::class, 'movie');

        $movieManager->deleteMovie($id);
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



    /**
     * Get the value of kind
     */ 
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * Set the value of kind
     *
     * @returnself
     */ 
    public function setKind($kind)
    {
        $this->kind = $kind;

        return $this;
    }

    /**
     * Get the value of director
     */ 
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set the value of director
     *
     * @returnself
     */ 
    public function setDirector($director)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get the value of main_actor
     */ 
    public function getMain_actor()
    {
        return $this->main_actor;
    }

    /**
     * Set the value of main_actor
     *
     * @returnself
     */ 
    public function setMain_actor($main_actor)
    {
        $this->main_actor = $main_actor;

        return $this;
    }

    /**
     * Get the value of nationality
     */ 
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationality
     *
     * @returnself
     */ 
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * Get the value of movie_type
     */ 
    public function getMovie_type()
    {
        return $this->movie_type;
    }

    /**
     * Set the value of movie_type
     *
     * @returnself
     */ 
    public function setMovie_type($movie_type)
    {
        $this->movie_type = $movie_type;

        return $this;
    }

    /**
     * Get the value of image_url
     */ 
    public function getImage_poster()
    {
        return $this->image_poster;
    }

    /**
     * Set the value of image_url
     *
     * @returnself
     */ 
    public function setImage_poster($image_poster)
    {
        $this->image_poster = $image_poster;

        return $this;
    }

    /**
     * Get the value of age_require
     */ 
    public function getAge_require()
    {
        return $this->age_require;
    }

    /**
     * Set the value of age_require
     *
     * @returnself
     */ 
    public function setAge_require($age_require)
    {
        $this->age_require = $age_require;

        return $this;
    }
}