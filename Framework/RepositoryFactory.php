<?php

namespace Framework;

use Model\Repository\IRepository;

class RepositoryFactory implements IRepository
{
    use PDOTrait;

    private $repositories = [];

    /**
     * This method returns 'Book|Category|Author...'Repository class
     */
    public function repository($entityName)
    {
        if (isset($this->repositories[$entityName])) {
            // echo 'Repo exists  -returning';
            return $this->repositories[$entityName];
        }

        $classname = "\\Model\Repository\\{$entityName}Repository";

        // todo: might check if file with repo exists
        $repo = new $classname();
        $repo->setPdo($this->pdo);
        $this->repositories[$entityName] = $repo;

        return $repo;
    }
}