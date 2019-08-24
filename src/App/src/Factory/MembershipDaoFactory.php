<?php


namespace App\Factory;


use App\Dao\MembershipDao;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class MembershipDaoFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $emTransactions = $container->get(EMTransactions::class);

        return new MembershipDao($em, $emTransactions);
    }
}