<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 04.11.17
 * Time: 1:44
 */

namespace Controller\API;


use Framework\Controller;

class Category extends Controller
{
    public function getAll($params=null){

        header('Access-Control-Allow-Origin: *');
        header("Content-Type: application/json");
        $repo=$this->container->get('repository_factory')->repository('Category');
        $data=array();
        $fetch=$repo->getAll();
        foreach ($fetch as $res){
            $data[]=array('id'=>$res->getId(),'name'=>$res->getName());
        }
        $status="200";
        if(empty($data))
        {
            $status="404";
        }
        $date=new \DateTime();
        return json_encode(['status'=>$status,'categories'=>$data,'lastUpdated'=>$date]);
    }



}