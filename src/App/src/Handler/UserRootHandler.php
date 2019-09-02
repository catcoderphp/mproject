<?php


namespace App\Handler;


use App\RestDispatchTrait;
use App\Service\UserRootService;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

/**
 * Class UserRootHandler
 * @package App\Handler
 */
class UserRootHandler
{
    use RestDispatchTrait;

    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;

    /**
     * @var HalResponseFactory
     */
    private $responseFactory;

    /**
     * @var UserRootService
     */
    private $userRootService;

    /**
     * UserRootHandler constructor.
     * @param ResourceGenerator $resourceGenerator
     * @param HalResponseFactory $responseFactory
     */
    public function __construct(ResourceGenerator $resourceGenerator,
                                HalResponseFactory $responseFactory,
                                UserRootService $userRootService)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->userRootService = $userRootService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return JsonResponse
     */
    public function post(ServerRequestInterface $request) : JsonResponse
    {

        return $this->createResponseByJsonObject([],[],200);
    }
}