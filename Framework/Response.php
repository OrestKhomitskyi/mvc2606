<?php

namespace Framework;

class Response
{
    private $body;
    private $headers;
    
    public function __construct($body)
    {
        $this->body = $body;
        $this->headers=$_SERVER;
    }
    
    public function __toString()
    {
        return (string) $this->body;
    }
}