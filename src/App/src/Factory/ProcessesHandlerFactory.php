<?php


namespace App\Factory;


use App\Handler\ProcessesHandler;
use App\Service\ProcessesService;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\ResponseFactory;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class ProcessesHandlerFactory
{
    public function __invoke(ContainerInterface $container): ProcessesHandler
    {
        $responseFactory = $container->get(HalResponseFactory::class);
        $resourceGenerator = $container->get(ResourceGenerator::class);
        $processService = $container->get(ProcessesService::class);

        return new ProcessesHandler($resourceGenerator,$responseFactory,$processService);
    }
}