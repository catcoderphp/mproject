<?php


namespace App\Model;


use App\Entity\CollaboratorEntity;

class Collaborator
{
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $phone;
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

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
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
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }


    public function map(CollaboratorEntity $collaboratorEntity)
    {
        $membershipResponse = [];
        $this->setId($collaboratorEntity->getId());
        $this->setName($collaboratorEntity->getName());
        $this->setLastname($collaboratorEntity->getLastname());
        $this->setEmail($collaboratorEntity->getEmail());
        $this->setPhone($collaboratorEntity->getPhone());
        $memberships = $collaboratorEntity->getMemberships();
        if (!is_null($memberships)) {
            foreach ($memberships as $membership) {
                $membershipResponse[] = [
                    "id" => $membership->getId(),
                    "name" => $membership->getName(),
                ];
            }
        }
        $this->setMemberships($membershipResponse);
        return $this;
    }

    public function toArray()
    {
        $tmp = json_encode($this);
        return json_decode($tmp,true);
    }
}