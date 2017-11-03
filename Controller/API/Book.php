<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 03.11.17
 * Time: 14:38
 */

namespace Controller\API;


use Framework\API;
use Framework\Controller;
use Framework\Request;
use Framework\Response;
use Model\Repository\BookRepository;
use MongoDB\BSON\Timestamp;

class Book extends API
{
    public function get($responseType,$params=null){
        header("Content-Type: application/json");
        $repo=$this->container->get('repository_factory')->repository('Book');
        $amount=$repo->getAmount();
        $data=$repo->getAll();
        $status="200";
        if(empty($data)){
            $status="404";
        }
        $date=new \DateTime();
        return  json_encode(['status'=>$status,'data'=>$data,$date]);
    }
    public function __construct()
    {
    }

}