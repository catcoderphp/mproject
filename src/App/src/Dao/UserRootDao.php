<?php


namespace App\Dao;


use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;

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
     * UserRootDao constructor.
     * @param EntityManager $em
     * @param EMTransactions $emTransactions
     */
    public function __construct(EntityManager $em, EMTransactions $emTransactions)
    {
        $this->em = $em;
        $this->emTransactions = $emTransactions;
    }
}