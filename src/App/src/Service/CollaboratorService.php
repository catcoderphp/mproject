<?php


namespace App\Service;


use App\Dao\CollaboratorDao;

class CollaboratorService
{
    private $collaboratorDao;

    public function __construct(CollaboratorDao $collaboratorDao)
    {
        $this->collaboratorDao = $collaboratorDao;
    }

    public function getById($id)
    {
        return $this->collaboratorDao->getById($id);
    }

    public function save($collaboratorEntity)
    {
        return $this->collaboratorDao->save($collaboratorEntity);
    }
}