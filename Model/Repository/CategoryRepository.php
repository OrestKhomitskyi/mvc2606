<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 04.11.17
 * Time: 1:45
 */

namespace Model\Repository;


use Framework\PDOTrait;
use Model\Entity\Category;

class CategoryRepository implements IRepository
{
    use PDOTrait;

    public function getAll(){
        $pdo = $this->pdo;
        $sth = $pdo->query("SELECT * FROM category");
        $collection=array();
        while ($data=$sth->fetch(\PDO::FETCH_ASSOC)){
            $category=new Category($data['id'],$data['name']);
            $collection[]=$category;
        }
        return $collection;
    }
    public function fetchBooksAuthors(){
        $pdo = $this->pdo;

        $sql=("select  book.id as book_id, book.title as book_title,
        category.id as category_id,
  category.name as category_name,
        book.created as created,book.active as active,book.price as price
  ,group_concat( concat(author.first_name,' ',author.last_name)) as authors
from category
  RIGHT JOIN book on category.id = book.category_id
  LEFT JOIN book_author on book_author.book_id=book.id
  LEFT JOIN author on author.id=book_author.author_id
GROUP BY book.id");

        $sth=$pdo->query($sql);

        $collection=array();
        while ($data=$sth->fetch(\PDO::FETCH_ASSOC)){
            $mixedData=array('id'=>$data["book_id"],'book_title'=>$data["book_title"],
                'category_id'=>$data["category_id"],'category_name'=>$data["category_name"],
                'created'=>$data["created"],'active'=>(bool)$data["active"],'price'=>$data["price"],'authors'=>$data["authors"]);
            $collection[]=$mixedData;
        }
        return $collection;

    }
}