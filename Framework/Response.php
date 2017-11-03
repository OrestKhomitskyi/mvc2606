<?php

namespace Framework;

class Response
{
    private $body;
    private $headers;
    private $status;

    public function __construct($body,$status=200)
    {
        $this->body = $body;
        $this->headers=$_SERVER;
    }
    
    public function __toString()
    {
        return (string) $this->body;
    }
    public function json(){
        return json_encode($this->body);
    }
}