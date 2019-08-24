<?php


namespace App\Dao;


use App\Entity\CollaboratorEntity;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;

class CollaboratorDao
{
    private $em;
    private $emTransactions;
    private $repository;

    public function __construct(EntityManager $em, EMTransactions $emTransactions)
    {
        $this->em = $em;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(CollaboratorEntity::class);
    }

    public function getById($id): CollaboratorEntity
    {
        return $this->repository->find($id);
    }

    public function save($collaboratorEntity)
    {
        $this->emTransactions->persist($this->em, $collaboratorEntity);
    }
}