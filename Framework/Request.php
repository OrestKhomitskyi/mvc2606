<?php

namespace Framework;

class Request
{
    private $get = [];
    private $post = [];
    
    public function __construct($get, $post)
    {
        $this->get = $get;
        $this->post = $post;
    }
    
    public function get($key, $default = null)
    {
        return isset($this->get[$key]) ? $this->get[$key]: $default;
    }
    
    public function post($key, $default = null)
    {
        return isset($this->post[$key]) ? $this->post[$key]: $default;
    }
    
    public function isPost()
    {
        return (bool) $this->post;
    }
    public function getUri(){
        $uri=explode('?',$_SERVER['REQUEST_URI']);
        return $uri[0];
    }
    public function mergeGet($newGet){
        isset($newGet)?$this->get+=$newGet:$this->get;
        isset($newGet)?$_GET+=$newGet:$_GET;
    }

}