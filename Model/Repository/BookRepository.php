<?php

namespace Model\Repository;

use Framework\PDOTrait;
use Model\Entity\Book;
use Model\Entity\IEntity;
class BookRepository implements IRepository
{
    use PDOTrait;

    public function save(Book $book)
    {
        // todo: implement - check ID: if id===null => insert into.., else: update...
    }
    
    public function find($id)
    {
        $pdo = $this->pdo;
        $sth = $pdo->prepare('SELECT * FROM book WHERE id = :id');
        $sth->execute(['id' => $id]);
        $data = $sth->fetch(\PDO::FETCH_ASSOC);
        
        return (new Book())
            ->setId($data['id'])
            ->setTitle($data['title'])
            ->setDescription($data['description'])
            ->setPrice($data['price'])
            ->setActive($data['active'])
            ->setCreated($data['created'])
            ->setCategory($data['category_id'])
        ;
    }
    
    public function findAll($page,$offset)
    {
        $pdo = $this->pdo;
        $collection = [];
        $startPos=$page*$offset;
        $sth = $pdo->query("SELECT * FROM book  ORDER BY title LIMIT {$startPos},$offset");
        
        while ($data = $sth->fetch(\PDO::FETCH_ASSOC)) {
            $book = (new Book())
                ->setId($data['id'])
                ->setTitle($data['title'])
                ->setDescription($data['description'])
                ->setPrice($data['price'])
                ->setActive($data['active'])
                ->setCreated($data['created'])
                ->setCategory($data['category_id'])
            ;
            
            $collection[] = $book;
        }
        
        return $collection;
    }

    public function getAll(){
        $pdo = $this->pdo;
        $sth = $pdo->query("SELECT * FROM book");
        $data=$sth->fetchAll(\PDO::FETCH_ASSOC);

        return $data;
    }

    public function getAmount(){
        $sth=$this->pdo->query("SELECT COUNT(id) FROM book");
        return $sth->fetch()[0];
    }

    public function findActive()
    {
    }
}