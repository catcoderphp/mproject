<?php


namespace App\Factory;


use App\Dao\MembershipDao;
use App\Handler\CollaboratorHandler;
use App\Service\CollaboratorService;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class CollaboratorHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $collaboratorService = $container->get(CollaboratorService::class);
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $responseFactory = $container->get(HalResponseFactory::class);
        $membershipDao = $container->get(MembershipDao::class);
        return new CollaboratorHandler(
            $collaboratorService,
            $responseFactory,
            $resourceGenerator,
            $membershipDao
        );
    }
}