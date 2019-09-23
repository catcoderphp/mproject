<?php


namespace App\Service;


use App\Dao\ProcessesDao;
use App\Entity\ProcessesEntity;

class ProcessesService
{
    /**
     * @var ProcessesDao
     */
    private $processesDao;

    public function __construct(ProcessesDao $processesDao)
    {
        $this->processesDao = $processesDao;
    }

    public function createProcess(ProcessesEntity $processesEntity):ProcessesEntity
    {
        return $this->processesDao->createProcess($processesEntity);
    }

    public function verifyStatus(ProcessesEntity $processesEntity) :ProcessesEntity
    {
        return $this->processesDao->verifyStatus($processesEntity);
    }
}