<?php


namespace App\Factory;


use App\Dao\ClientDao;
use App\Dao\RangeDao;
use App\Service\ClientService;
use Psr\Container\ContainerInterface;

class ClientServiceFactory
{
    public function __invoke(ContainerInterface $container): ClientService
    {
        $clientDao = $container->get(ClientDao::class);
        $rangeDao = $container->get(RangeDao::class);

        return new ClientService($clientDao, $rangeDao);
    }
}