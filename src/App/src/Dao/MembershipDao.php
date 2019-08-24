<?php


namespace App\Dao;


use App\Entity\MembershipEntity;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;

class MembershipDao
{
    private $em;
    private $emTransactions;
    private $repository;

    public function __construct(EntityManager $em, EMTransactions $emTransactions)
    {
        $this->em = $em;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(MembershipEntity::class);
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }
}