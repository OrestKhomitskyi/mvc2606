<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 04.11.17
 * Time: 2:23
 */

namespace Controller\API;

use Framework\Controller;

class Author extends Controller
{
    public function getAll($params=null){

        header('Access-Control-Allow-Origin: *');
        //header("Content-Type: application/json");
        $repo=$this->container->get('repository_factory')->repository('Author');
        $data=array();

        $fetch=$repo->getAll();
        foreach ($fetch as $res){
            $data[]=array('id'=>$res->getId(),'first_name'=>$res->getFirstName(),'last_name'=>$res->getLastName());
        }
        $status="200";
        if(empty($data))
        {
            $status="404";
        }
        $date=new \DateTime();
        return json_encode(['status'=>$status,'authors'=>$data,'lastUpdated'=>$date]);
    }
}