<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 25.10.17
 * Time: 1:34
 */

namespace Framework;


class Route
{
    public $pattern;
    public $controller;
    public $action;
    public $params;
    public $name;
    public $isAdmin;

    /**
     * Route constructor.
     * @param $pattern
     * @param $controller
     * @param $action
     * @param $params
     */
    public function __construct($name,$pattern, $controller, $action, array $params=null,$isAdmin=false)
    {
        $this->name=$name;
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
        $this->isAdmin=$isAdmin;
    }

    public function isAdmin(){
        $check=false;
        if(strpos($this->pattern,'/admin')===0) $check=true;
        return $check;
    }



}