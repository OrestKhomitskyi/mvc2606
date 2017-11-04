<?php
namespace Model\Repository;
use Model\Entity\User;
class UserRepository
{
    private $pdo;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

    public function findByEmail($email)
    {
        $sth = $this->pdo->prepare('SELECT * FROM user WHERE email = :email AND active = 1 LIMIT 1');
        $sth->execute(compact('email'));
        $data = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }
        return (new User())
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setRole($data['role'])
            ->setApiKey($data['api_key']);
    }
    public function findByEmailPass($email,$pass){

    }
    public function checkApi($key){
        $sth=$this->pdo->prepare('SELECT id FROM user WHERE api_key=:key');
        $sth->execute(['key'=>$key]);
        if($sth->fetch()==false) {
            return false;
        }
        return true;
    }


}