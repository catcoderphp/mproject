<?php


namespace App\Utils;


use Doctrine\ORM\EntityManager;

class EMTransactions
{
    public function persist(EntityManager $entityManager, $object)
    {
        $entityManager->getConnection()->beginTransaction();
        try {
            $entityManager->persist($object);
            $entityManager->flush();
            $entityManager->getConnection()->commit();
        } catch (\Exception $exception) {
            error_log("entra aca");
            $entityManager->getConnection()->rollBack();
            throw $exception;
        }
    }
}