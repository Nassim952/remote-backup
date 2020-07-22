<?php

namespace cms\models;

use cms\core\Model;
use cms\core\ModelInterface;

class Section extends Model implements ModelInterface
{
    protected $id;
    protected $size;
    protected $page_id;
    protected $position;

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
     * @returnself
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of size
     */ 
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @returnself
     */ 
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of page_id
     */ 
    public function getPage_id()
    {
        return $this->page_id;
    }

    /**
     * Set the value of page_id
     *
     * @returnself
     */ 
    public function setPage_id($page_id)
    {
        $this->page_id = $page_id;

        return $this;
    }

    /**
     * Get the value of position
     */ 
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @returnself
     */ 
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
}