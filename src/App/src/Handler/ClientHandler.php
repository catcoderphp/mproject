<?php


namespace App\Handler;


use App\RestDispatchTrait;
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

    public function __construct(ResourceGenerator $resourceGenerator, HalResponseFactory $responseFactory)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->halResponseFactory = $responseFactory;
    }

    public function get(ServerRequestInterface $serverRequest): JsonResponse
    {
        $data = ["hello" => time()];
        return $this->createResponseByJsonObject($data);
    }
}