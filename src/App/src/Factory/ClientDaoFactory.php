<?php


namespace App\Factory;


use App\Dao\ClientDao;
use App\Dao\RangeDao;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ClientDaoFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $emTransactions = $container->get(EMTransactions::class);
        $rangeDao = $container->get(RangeDao::class);
        return new ClientDao($em,$emTransactions,$rangeDao);
    }
}