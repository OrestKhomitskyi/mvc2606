<?php

namespace Model\Repository;

use Framework\PDOTrait;
use Model\Entity\Feedback;
use Model\Entity\IEntity;

class FeedbackRepository implements IRepository
{
    use PDOTrait;

    public function save(Feedback $feedback)
    {
        $data = [
            'email' => $feedback->getEmail(),
            'message' => $feedback->getMessage(),
            'created' => $feedback->getMySqlCreated(),
            'ip'=>$feedback->getIp()
        ];

        $sql = "INSERT INTO mvc.feedback (email, message, created, ip) VALUES (:email,:message,:created,:ip)";
        $sth = $this->pdo->prepare($sql);
        $sth->execute($data);
    }
}