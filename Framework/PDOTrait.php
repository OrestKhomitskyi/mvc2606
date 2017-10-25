<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 14.10.17
 * Time: 13:38
 */

namespace Framework;


trait PDOTrait
{
    private $pdo;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

}