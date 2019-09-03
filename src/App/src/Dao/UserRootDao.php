<?php


namespace App\Dao;


use App\Entity\UserRootEntity;
use App\Entity\UserSession;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Repository\RepositoryFactory;
use function Sodium\randombytes_random16;

/**
 * Class UserRootDao
 * @package App\Dao
 */
class UserRootDao
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EMTransactions
     */
    private $emTransactions;

    /**
     * @var RepositoryFactory
     */
    private $repository;

    /**
     * UserRootDao constructor.
     * @param EntityManager $em
     * @param EMTransactions $emTransactions
     */
    public function __construct(EntityManager $em, EMTransactions $emTransactions)
    {
        $this->em = $em;
        $this->emTransactions = $emTransactions;
        $this->repository = $this->em->getRepository(UserRootEntity::class);
    }

    public function login($email,$password)
    {
        $password = md5($email.$password);
        $login = $this->repository->findOneBy(["password" => $password]);
        return $login;
    }

    public function createSession(UserRootEntity $userRootEntity)
    {
        $sessionRepo = $this->em->getRepository(UserSession::class);
        $sessionEntity = new UserSession();
        $token = md5(md5($userRootEntity->getEmail().time().random_bytes(32)));
        $sessionEntity->setToken($token);
        $sessionEntity->setTtl(time() + (3600 * 24));
        $sessionEntity->setUser($userRootEntity);
        $this->emTransactions->persist($this->em,$sessionEntity);
        return $sessionRepo->findOneBy(["token" => $sessionEntity->getToken()]);
    }
}