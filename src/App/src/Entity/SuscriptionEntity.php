<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="suscriptions")
 */
class SuscriptionEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\OneToOne(targetEntity="CollaboratorEntity",mappedBy="suscription")
     * @ORM\JoinColumn(name="collaborator_id",referencedColumnName="id")
     */
    private $collaborator;
    /**
     * @ORM\OneToOne(targetEntity="MembershipEntity",mappedBy="suscription")
     * @ORM\JoinColumn(name="membership_id",referencedColumnName="id")
     */
    private $membership;
    /**
     * @ORM\Column(type="string")
     */
    private $ttl;
    /**
     * @ORM\Column(type="string")
     */
    private $active;

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
        return $this->collaborator;
    }

    /**
     * @param mixed $collaborator
     */
    public function setCollaborator($collaborator): void
    {
        $this->collaborator = $collaborator;
    }

    /**
     * @return mixed
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * @param mixed $membership
     */
    public function setMembership($membership): void
    {
        $this->membership = $membership;
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

}