<?php


namespace App\Factory;


use App\Dao\CollaboratorDao;
use App\Service\CollaboratorService;
use Psr\Container\ContainerInterface;

class CollaboratorServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $collaboratorDao = $container->get(CollaboratorDao::class);
        return new CollaboratorService($collaboratorDao);
    }
}