<?php


namespace App\Dao;


use App\Entity\RangeEntity;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory;

class RangeDao
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var RepositoryFactory
     */
    private $repository;

    /**
     * @var EMTransactions
     */
    private $emTransactions;

    public function __construct(EntityManager $entityManager, EMTransactions $emTransactions)
    {
        $this->em = $entityManager;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(RangeEntity::class);
    }

    public function getById($id): RangeEntity
    {
        return $this->repository->find($id);
    }
}