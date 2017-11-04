<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 04.11.17
 * Time: 2:34
 */

namespace Model\Repository;

use Framework\PDOTrait;
use Model\Entity\Author;
class AuthorRepository implements IRepository
{
    use PDOTrait;

    public function getAll(){
        $pdo = $this->pdo;
        $sth = $pdo->query("SELECT * FROM author");
        $collection=array();
        while ($data=$sth->fetch(\PDO::FETCH_ASSOC)){
            $category=new Author($data['id'],$data['first_name'],$data['last_name']);
            $collection[]=$category;
        }
        return $collection;
    }
}