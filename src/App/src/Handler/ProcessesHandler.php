<?php


namespace App\Handler;


use App\Entity\ProcessesEntity;
use App\Model\ResponseHandler;
use App\RestDispatchTrait;
use App\Service\ProcessesService;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Http\Response;

class ProcessesHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;
    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;
    /**
     * @var ResponseFactory
     */
    private $responseFactory;
    /**
     * @var ProcessesService
     */
    private $processService;

    public function __construct(
        ResourceGenerator $resourceGenerator,
        ResponseFactory $responseFactory,
        ProcessesService $processesService)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->processService = $processesService;
    }

    public function post(): JsonResponse
    {
        $headers = [
            "Content-Type" => "Application/json"
        ];
        $processesEntity = new ProcessesEntity();
        var_dump($this->processService->verifyStatus($processesEntity));die;
        $response = new ResponseHandler();
        $response->setData([]);
        $response->setError(false);
        $response->setMessage("Message");
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->buildMeta(0, 0, 0);
        return $this->createResponseByJsonObject([], $headers, $response->getStatusCode());
    }
}