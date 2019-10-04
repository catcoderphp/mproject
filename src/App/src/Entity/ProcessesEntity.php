<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="processes")
 */
class ProcessesEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $collaborator_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $client_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;
    /**
     * @ORM\Column(type="integer")
     */
    private $status_id;
    /**
     * @ORM\Column(type="boolean")
     */
    private $active;
    /**
     * @ORM\Column(type="integer")
     */
    private $date;

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
    public function getCollaborator()
    {
        return $this->collaborator_id;
    }

    /**
     * @param mixed $collaborator
     */
    public function setCollaborator($collaborator): void
    {
        $this->collaborator_id = $collaborator;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client_id;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client_id = $client;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user_id = $user;
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
}