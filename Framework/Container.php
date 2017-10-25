<?php

namespace Framework;

class Container implements ContainerInterface
{
    private $objects = [];
    
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
}