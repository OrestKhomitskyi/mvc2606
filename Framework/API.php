<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 03.11.17
 * Time: 14:39
 */

namespace Framework;


use Model\Entity\User;

 class API extends Controller
{
    private $api_list=array();

    private $current_api;
    /**
     * API constructor.
     * @param array $api_list
     */
    public function __construct(array $api_list)
    {
        $this->api_list = $api_list;
    }
    public function match(Request $request){

        $repo=$this->container->get('repository_factory')->repository('User');
        $uri=$request->getUri();
        $controller='\\Controller\\API\\'.ucfirst($request->get('controller'));

        $Apicontroller=new $controller();
        $Apicontroller->setContainer($this->container);
        $method=$request->get('method');

        $this->current_api=$this->api_list[ucfirst($request->get('controller'))];
        if(!$this->current_api )
        {
            throw new \Exception("Api: {$this->current_api} not found");
        }
        if(!method_exists($Apicontroller,$method)){
            throw new \Exception("Api: {$this->current_api}, Method: {$method} not found");
        }
        if($repo->checkApi($request->get('API_KEY'))==false){
            throw new \Exception('Invalid api_key');
        }
        $parameters=$this->current_api["parameters"];

        return $Apicontroller->$method($parameters);
    }




}