<?php

namespace Framework;

class Container implements ContainerInterface
{
    private $objects = [];
    private $parameteres=[];

    /**
     * @return array
     */
    public function getParameter($key)
    {
       return $this->getValue($this->parameteres,$key);
    }

    /**
     * @param array $parameteres
     */
    public function setParameteres(array $parameteres)
    {
        $this->parameteres = $parameteres;
    }



    public function get($key)
    {
        if (isset($this->objects[$key])) {
            return $this->objects[$key];
        }
        
        return null;
    }
    public function set($key, $object)
    {
        $this->objects[$key] = $object;
    }

    public function getParametre($key){
        return $this->getValue($this->objects,$key);
    }

    public function getValue(array $array,$key){

    }

}