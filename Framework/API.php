<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 03.11.17
 * Time: 14:39
 */

namespace Framework;


class API
{
    private $api_list=array();
    protected $controller;
    protected $current_api;
    protected $container;
    /**
     * API constructor.
     * @param array $api_list
     */
    public function __construct(array $api_list)
    {
        $this->api_list = $api_list;
    }
    public function match(Request $request){

        $uri=$request->getUri();
        $controller='\\Controller\\API\\'.ucfirst($request->get('controller'));
        $Apicontroller=new $controller();
        $Apicontroller->setContainer($this->container);

        $method=$request->get('method');
        $this->current_api=$this->api_list[ucfirst($request->get('controller'))];
        if(!$this->current_api
            || !method_exists($Apicontroller,$method)
        )
        {
            throw new \Exception("Wrong");
        }
        $responseType=$this->current_api["resp"];
        $params=$this->current_api["params"];
        return $Apicontroller->$method($responseType,$params);
    }
    public function setContainer($container){
        $this->container=$container;
    }



}