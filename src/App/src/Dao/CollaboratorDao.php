<?php


namespace App\Dao;


use App\Entity\CollaboratorEntity;
use App\Entity\CollaboratorSessionEntity;
use App\Entity\MembershipEntity;
use App\Utils\EMTransactions;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class CollaboratorDao
{
    private $em;
    private $emTransactions;
    private $repository;
    private $collaboratorSessionRepo;

    public function __construct(EntityManager $em, EMTransactions $emTransactions)
    {
        $this->em = $em;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(CollaboratorEntity::class);
        $this->collaboratorSessionRepo = $this->em->getRepository(CollaboratorSessionEntity::class);
    }

    public function getById($id): CollaboratorEntity
    {
        return $this->repository->find($id);
    }

    public function getByToken($token)
    {
        return $this->collaboratorSessionRepo->findOneBy(["token" => $token]);
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

    public function login($email, $passwd)
    {
        $uniquePassword = md5(trim($passwd) . trim($email));
        $collaborator = $this->repository->findOneBy(["password" => $uniquePassword]);
        return $collaborator;
    }

    public function createSession(CollaboratorEntity $collaboratorEntity, $is_new = false)
    {
        if (!$is_new) {
            return $this->findActiveSession($collaboratorEntity);
        } else {
            $collaboratorSession = new CollaboratorSessionEntity();
            $token = md5(md5($collaboratorEntity->getEmail() . time() . random_bytes(32)));
            $collaboratorSession->setToken($token);
            $collaboratorSession->setCollaborator($collaboratorEntity);
            $collaboratorSession->setTtl(time() + (3600 * 24));
            $this->emTransactions->persist($this->em, $collaboratorSession);
            return $this->collaboratorSessionRepo->findOneBy(["token" => $collaboratorSession->getToken()]);

        }
    }

    public function findActiveSession(CollaboratorEntity $collaboratorEntity)
    {
        $lastSession = $collaboratorEntity->getSession();

        if ($lastSession instanceof CollaboratorSessionEntity) {
            if (!($lastSession->getTtl() > time())) {

                $this->emTransactions->remove($this->em, $lastSession);
                $collaboratorEntity->setSession(null);
                return $this->createSession($collaboratorEntity, true);
            } else {
                return $this->collaboratorSessionRepo->findOneBy(["token" => $lastSession->getToken()]);
            }
        } else {
            return $this->createSession($collaboratorEntity, true);
        }
    }

}