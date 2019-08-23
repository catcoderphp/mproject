<?php


namespace App\Factory;


use App\Handler\ClientHandler;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class ClientHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $halResponseFactory = $container->get(HalResponseFactory::class);

        return new ClientHandler($resourceGenerator,$halResponseFactory);
    }
}