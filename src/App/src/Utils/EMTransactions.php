<?php


namespace App\Utils;


use Doctrine\ORM\EntityManager;

class EMTransactions
{
    private $em;
    private $executions;

    public function persist(EntityManager $entityManager, $object)
    {
        $action = "persist";
        $this->emDriver($entityManager, $object, $action);
    }

    private final function emDriver(EntityManager $entityManager, $object, $action)
    {
        $this->em = $entityManager;
        $this->executions = [
            "persist" => function () use (&$entityManager, &$object) {
                $entityManager->persist($object);
            },
            "remove" => function () use (&$entityManager, &$object) {
                $entityManager->remove($object);
            }
        ];


        $this->em->getConnection()->beginTransaction();
        try {
            $this->executions[$action]();
            $entityManager->flush();
            $entityManager->getConnection()->commit();

        } catch (\Exception $exception) {
            error_log("entra aca");
            $entityManager->getConnection()->rollBack();
            throw $exception;
        }
    }

    public function remove(EntityManager $entityManager, $object)
    {
        $action = "remove";
        $this->emDriver($entityManager, $object, $action);
    }
}