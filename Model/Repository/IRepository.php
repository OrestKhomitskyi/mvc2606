<?php
/**
 * Created by PhpStorm.
 * User: orest
 * Date: 14.10.17
 * Time: 1:25
 */

namespace Model\Repository;

use Model\Entity\IEntity;



interface IRepository
{
    public function setPdo(\PDO $PDO);
}