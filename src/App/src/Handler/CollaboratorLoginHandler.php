<?php


namespace App\Handler;


use App\RestDispatchTrait;
use App\Service\CollaboratorService;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class CollaboratorLoginHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;
    /**
     * @var HalResponseFactory
     */
    private $responseFactory;
    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;

    /**
     * @var CollaboratorService
     */
    private $collaboratorService;

    /**
     * CollaboratorLoginHandler constructor.
     * @param HalResponseFactory $responseFactory
     * @param ResourceGenerator $resourceGenerator
     */
    public function __construct(
        HalResponseFactory $responseFactory,
        ResourceGenerator $resourceGenerator,
        CollaboratorService $collaboratorService)
    {
        $this->responseFactory = $responseFactory;
        $this->resourceGenerator = $resourceGenerator;
        $this->collaboratorService = $collaboratorService;
    }

    public final function post(ServerRequest $request): JsonResponse
    {
        $response = $this->collaboratorService->login($request);
        return $this->createResponseByJsonObject($response, [], $response->getStatusCode());
    }
}