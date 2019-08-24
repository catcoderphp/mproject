<?php


namespace App\Dao;


use App\Entity\ClientEntity;
use App\Entity\RangeEntity;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory;

class ClientDao
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

    /**
     * @var RangeDao
     */
    private $rangeDao;

    public function __construct(
        EntityManager $entityManager,
        EMTransactions $emTransactions,
        RangeDao $rangeDao
    )
    {
        $this->em = $entityManager;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(ClientEntity::class);
        $this->rangeDao = $rangeDao;
    }

    public function getById($id): ?ClientEntity
    {
        return $this->repository->find($id);
    }

    public function save(ClientEntity $clientEntity): ?ClientEntity
    {
        $range = $this->rangeDao->getById($clientEntity->getRange());

        if ($range instanceof RangeEntity) {
            $clientEntity->setRange($range);
            $this->emTransactions->persist($this->em, $clientEntity);
            return $clientEntity;
        }
        return null;
    }
}