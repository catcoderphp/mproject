<?php


namespace App\Model;


use App\Entity\ProcessesEntity;

class Processes
{
    public $id;
    public $collaborator_id;
    public $client_id;
    public $user_id;
    public $status_id;
    public $active;
    public $date;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCollaboratorId()
    {
        return $this->collaborator_id;
    }

    /**
     * @param mixed $collaborator_id
     */
    public function setCollaboratorId($collaborator_id): void
    {
        $this->collaborator_id = $collaborator_id;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client_id
     */
    public function setClientId($client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getStatusId()
    {
        return $this->status_id;
    }

    /**
     * @param mixed $status_id
     */
    public function setStatusId($status_id): void
    {
        $this->status_id = $status_id;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function map(ProcessesEntity $processesEntity) {
        $this->setId($processesEntity->getId());
        $this->setUserId($processesEntity->getUser());
        $this->setClientId($processesEntity->getClient());
        $this->setStatusId($processesEntity->getStatusId());
        $this->setCollaboratorId($processesEntity->getCollaborator());
        $this->setActive($processesEntity->getActive());
        $this->setDate($processesEntity->getDate());

        return $this;
    }

}