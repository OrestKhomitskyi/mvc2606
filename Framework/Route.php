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
    public  $params;


    /**
     * Route constructor.
     * @param $pattern
     * @param $controller
     * @param $action
     * @param $params
     */
    public function __construct($pattern, $controller, $action, array $params=null)
    {
        $this->pattern = $pattern;
        $this->controller = $controller;
        $this->action = $action;
        $this->params = $params;
    }


}