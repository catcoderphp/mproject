<?php


namespace App\Handler;


use App\RestDispatchTrait;
use App\Service\ClientService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

class ClientHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;

    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;

    /**
     * @var HalResponseFactory
     */
    private $halResponseFactory;

    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory,
        ClientService $clientService
    )
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->halResponseFactory = $responseFactory;
        $this->clientService = $clientService;
    }

    public function get(ServerRequestInterface $serverRequest): JsonResponse
    {
        $request = $serverRequest->getQueryParams();
        $headers = [];
        $response = $this->clientService->getById($request["id"]);
        return $this->createResponseByJsonObject($response, $headers, $response->getStatusCode());
    }

    public function post(ServerRequestInterface $serverRequest): JsonResponse
    {
        $request = $serverRequest->getParsedBody();
        $headers = [];
        $response = $this->clientService->save($request);
        var_dump($response);die;
        return $this->createResponseByJsonObject($response, $headers, $response->getStatusCode());
    }
}