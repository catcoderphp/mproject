<?php


namespace App\Factory;


use App\Dao\RangeDao;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class RangeDaoFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $em = $container->get(EntityManager::class);
        $emTransactions = $container->get(EMTransactions::class);
        return new RangeDao($em,$emTransactions);
    }
}