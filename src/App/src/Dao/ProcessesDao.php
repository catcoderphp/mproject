<?php


namespace App\Dao;


use App\Entity\ProcessesEntity;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;

class ProcessesDao
{
    private $repo;
    private $emTransactions;
    private $entityManager;

    public function __construct(EntityManager $entityManager, EMTransactions $emTransactions)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository(ProcessesEntity::class);
        $this->emTransactions = $emTransactions;
    }

    public function createProcess(ProcessesEntity $processesEntity) :ProcessesEntity
    {
        $this->emTransactions->persist($this->entityManager, $processesEntity);
        return $processesEntity;
    }

    public function verifyStatus(ProcessesEntity $processesEntity):?ProcessesEntity
    {

        $process = $this->repo->findOneBy([
            "collaborator_id" => $processesEntity->getCollaborator(),
            "client_id" => $processesEntity->getClient(),
        ]);
        if (empty($process))
        {
            $process = null;
        }
        return $process;
    }
}