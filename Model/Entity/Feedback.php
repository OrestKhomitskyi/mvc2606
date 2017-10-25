<?php

namespace Model\Entity;

class Feedback
{
    private $id;
    
    private $email;
    
    private $message;
    
    private $created;

    private $ip;
      /**
     * Feedback constructor.
     * 
     * @param $id
     * @param $email
     * @param $message
     */
    public function __construct($email, $message)
    {
        $this->email = $email;
        $this->message = $message;
        $this->created = new \DateTime();
        $this->ip=$_SERVER['REMOTE_ADDR'];
    }
    
    public function getMySqlCreated()
    {
        return $this->created->format('Y-m-d H:i:s');
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        
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
}