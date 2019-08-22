<?php

declare(strict_types=1);

namespace App\Handler;

use App\Entity\Foo;
use App\Entity\FooEntity;
use App\RestDispatchTrait;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Http\Response;

class DataProviderHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;

    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;

    /**
     * @var HalResponseFactory\
     */
    private $responseFactory;

    /**
     * @var EntityManager
     */
    private $entityManager;


    public function __construct(
        EntityManager $entityManager,
        ResourceGenerator $resourceGenerator, HalResponseFactory $responseFactory)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->entityManager = $entityManager;
    }


    public function get(ServerRequestInterface $request) : ResponseInterface
    {
        $em = $this->entityManager->getRepository(FooEntity::class);;
        return $this->createResponseByJsonObject($em->findAll(), [],Response::STATUS_CODE_200);
    }
}
