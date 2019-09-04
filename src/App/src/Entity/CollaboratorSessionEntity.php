<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="collaborator_session")
 */
class CollaboratorSessionEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $token;
    /**
     * @ORM\Column(type="string")
     */
    private $ttl;
    /**
     * @ORM\OneToOne(targetEntity="CollaboratorEntity",mappedBy="session")
     * @ORM\JoinColumn(name="collaborator_id",referencedColumnName="id")
     */
    private $collaborator;

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
    public function getCollaborator()
    {
        return $this->collaborator;
    }

    /**
     * @param mixed $collaborator
     */
    public function setCollaborator($collaborator): void
    {
        $this->collaborator = $collaborator;
    }
}