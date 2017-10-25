<?php

namespace Framework;

class Router
{
    private $currentRoute;
    private $routes;



    public  function __construct($file)
    {
        $this->routes=require $file;
    }


    public function match(Request $request){
        $uri=$request->getUri();
        foreach ($this->routes as $route) {
            $pattern = $route->pattern;


            foreach ($route->params as $key=>$value){
                $pattern=str_replace('{'.$key.'}',"($value)",$pattern);
            }
            $pattern='@^'.$pattern.'$@';

            if(preg_match($pattern,$uri,$matches)){

                $this->currentRoute=$route;

                array_shift($matches);

                $getParams=array_combine(array_keys($route->params),$matches);

                $request->mergeGet($getParams);
                break;
            }
            }


    }
    public function redirect($to)
    {
        header("Location: {$to}");
        die;
    }

    public function getCurrent(){
        return $this->currentRoute;
    }

}