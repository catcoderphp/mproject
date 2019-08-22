<?php

declare(strict_types=1);

namespace App\Factory;

use App\Handler\DataProviderHandler;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class DataProviderHandlerFactory
{
    public function __invoke(ContainerInterface $container) : DataProviderHandler
    {

            $entityManager = $container->get(EntityManager::class);

        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        return new DataProviderHandler($entityManager,$resourceGenerator,$responseFactory);
    }
}
