<?php


namespace App\Factory;


use App\Dao\ProcessesDao;
use App\Service\ProcessesService;
use Psr\Container\ContainerInterface;

class ProcessesServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $processesDao = $container->get(ProcessesDao::class);
        return new ProcessesService($processesDao);
    }
}