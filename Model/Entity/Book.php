<?php

namespace Model\Entity;

use MongoDB\BSON\Timestamp;

class Book
{
    private $id;
    
    private $title;
    
    private $description;
    
    private $price;
    
    private $active;
    
    private $created;
    
    private $category;

    /**
     * Book constructor.
     * @param $title
     * @param $description
     * @param $price
     * @param $active
     * @param $created
     * @param $category
     */
    public function __construct($title, $description, $price , $category)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->created = new \DateTime();
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    public function getShortDescription()
    {
        return substr($this->description,0,50).'...';
        // todo: return substr($this->description ... );
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = (bool) $active;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
        
        return $this;
    }
}