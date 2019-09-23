<?php


namespace App\Factory;


use App\Handler\ProcessesHandler;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\ResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class ProcessesHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProcessesHandler
    {
        $responseFactory = $container->get(ResponseFactory::class);
        $resourceGenerator = $container->get(ResourceGenerator::class);

        return new ProcessesHandler($responseFactory, $resourceGenerator);
    }
}