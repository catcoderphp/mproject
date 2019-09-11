<?php


namespace App\Factory;


use App\Dao\CollaboratorDao;
use App\Handler\MembershipHandler;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class MembershipHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        $collaboratorDao = $container->get(CollaboratorDao::class);
        return new MembershipHandler($resourceGenerator, $responseFactory, $collaboratorDao);
    }
}