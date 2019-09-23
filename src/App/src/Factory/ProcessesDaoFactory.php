<?php


namespace App\Factory;


use App\Dao\ProcessesDao;
use App\Utils\EMTransactions;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class ProcessesDaoFactory
{
    public function __invoke(ContainerInterface $container): ProcessesDao
    {
        $entityManager = $container->get(EntityManager::class);
        $emTransactions = $container->get(EMTransactions::class);
        return new ProcessesDao($entityManager, $emTransactions);
    }
}