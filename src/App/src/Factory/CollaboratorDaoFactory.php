<?php


namespace App\Factory;


use App\Dao\CollaboratorDao;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class CollaboratorDaoFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $emTransactions = $container->get(EMTransactions::class);

        return new CollaboratorDao($em, $emTransactions);
    }
}