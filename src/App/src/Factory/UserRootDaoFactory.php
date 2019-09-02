<?php


namespace App\Factory;


use App\Dao\UserRootDao;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class UserRootDaoFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $emTransactions = $container->get(EMTransactions::class);

        return new UserRootDao($em,$emTransactions);
    }
}