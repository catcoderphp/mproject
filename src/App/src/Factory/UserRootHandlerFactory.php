<?php


namespace App\Factory;


use App\Handler\UserRootHandler;
use App\Service\UserRootService;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class UserRootHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        $userRootService = $container->get(UserRootService::class);
        return new UserRootHandler($resourceGenerator, $responseFactory, $userRootService);
    }
}