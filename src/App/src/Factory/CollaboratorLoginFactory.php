<?php


namespace App\Factory;


use App\Handler\CollaboratorLoginHandler;
use App\Service\CollaboratorService;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class CollaboratorLoginFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        $collaboratorService = $container->get(CollaboratorService::class);
        return new CollaboratorLoginHandler($responseFactory, $resourceGenerator, $collaboratorService);
    }
}