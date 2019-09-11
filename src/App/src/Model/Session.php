<?php


namespace App\Model;


use App\Entity\CollaboratorSessionEntity;

class Session
{
    public $token;
    public $email;
    public $ttl;
    public $name;
    public $memberships;

    /**
     * @return mixed
     */
    public function getMemberships()
    {
        return $this->memberships;
    }

    /**
     * @param mixed $memberships
     */
    public function setMemberships($memberships): void
    {
        $this->memberships = $memberships;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param mixed $ttl
     */
    public function setTtl($ttl): void
    {
        $this->ttl = $ttl;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function map(CollaboratorSessionEntity $collaboratorSessionEntity)
    {
        $this->setName($collaboratorSessionEntity->getCollaborator()->getName());
        $this->setTtl($collaboratorSessionEntity->getTtl());
        $this->setEmail($collaboratorSessionEntity->getCollaborator()->getEmail());
        $this->setToken($collaboratorSessionEntity->getToken());
        $collaboratorModel = new Collaborator();
        $collaboratorModel->map($collaboratorSessionEntity->getCollaborator());
        $this->setMemberships($collaboratorModel->getMemberships());

        return $this;
    }
}