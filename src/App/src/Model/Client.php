<?php


namespace App\Model;


use App\Entity\ClientEntity;
use phpDocumentor\Reflection\Types\This;

class Client
{
    public $id;

    public $name;

    public $lastname;

    public $email;

    public $phone;

    public $range;

    public $active;

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

    /**
     * @return mixed
     */
    public function getRange()
    {
        return $this->range;
    }

    /**
     * @param mixed $range
     */
    public function setRange($range): void
    {
        $this->range = $range;
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

    public function mapObject(ClientEntity $clientEntity) : ?Client
    {
        $client = new Client();
        $rangeData = [
            "id" => $clientEntity->getRange()->getId(),
            "name" => $clientEntity->getRange()->getName()
        ];
        $client->setRange($rangeData);
        $client->setId($clientEntity->getId());
        $client->setPhone($clientEntity->getPhone());
        $client->setLastname($clientEntity->getLastname());
        $client->setName($clientEntity->getName());
        $client->setEmail($clientEntity->getEmail());
        $client->setActive($clientEntity->getVisible());

        return $client;
    }

}