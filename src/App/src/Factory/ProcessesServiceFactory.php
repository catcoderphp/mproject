<?php


namespace App\Factory;


use App\Service\ProcessesService;
use Psr\Container\ContainerInterface;

class ProcessesServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $processesService = $container->get(ProcessesService::class);
        return new ProcessesService($processesService);
    }
}