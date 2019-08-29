<?php


namespace App\Dao;


use App\Entity\CollaboratorEntity;
use App\Entity\MembershipEntity;
use App\Utils\EMTransactions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class CollaboratorDao
{
    private $em;
    private $emTransactions;
    private $repository;

    public function __construct(EntityManager $em, EMTransactions $emTransactions)
    {
        $this->em = $em;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(CollaboratorEntity::class);
    }

    public function getById($id): CollaboratorEntity
    {
        return $this->repository->find($id);
    }

    public function haveMembership($membership_id, $collaborator_id)
    {
        $connection = $this->em->getConnection();
        $sql = 'SELECT * FROM collaborators_memberships where collaborator_id = %d and membership_id = %d';
        $cleanSql = sprintf($sql, $collaborator_id, $membership_id);
        $statement = $connection->prepare($cleanSql);
        $statement->execute();
        return !empty($statement->fetch());

    }

    public function addMembership(MembershipEntity $membership, CollaboratorEntity $collaborator)
    {
        if ($collaborator->getMemberships()->count()) {
            $collaborator->getMemberships()->add($membership);
        } else {
            $persistenceObject = new ArrayCollection();
            $persistenceObject->add($membership);
            $collaborator->setMemberships($persistenceObject);
        }

        $this->save($collaborator);
    }

    public function save($collaboratorEntity)
    {
        $this->emTransactions->persist($this->em, $collaboratorEntity);
    }
}