<?php


namespace App\Handler;


use App\Entity\ProcessesEntity;
use App\Model\Processes;
use App\Model\ResponseHandler;
use App\RestDispatchTrait;
use App\Service\ProcessesService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ResponseFactory;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Hal\HalResponseFactory;
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
        HalResponseFactory $responseFactory,
        ProcessesService $processesService)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->processService = $processesService;
    }

    public function post(ServerRequestInterface $request): JsonResponse
    {
        $headers = [
            "Content-Type" => "Application/json"
        ];
        $data = $request->getParsedBody();
        $processesEntity = new ProcessesEntity();
        $processesEntity->setCollaborator($data["collaborator_id"]);
        $processesEntity->setClient($data["client_id"]);
        $processesEntity->setUser(1);
        $processesEntity->setDate(time());
        $processesEntity->setActive(true);
        $processesEntity->setStatusId(1);
        $processExist = $this->processService->verifyStatus($processesEntity);
        if (is_null($processExist)) {
            $processesEntity = $this->processService->createProcess($processesEntity);
        }
        $response = new ResponseHandler();
        $process = new Processes();
        $response->setData($process->map($processesEntity));
        $response->setError(false);
        $response->setMessage("Message");
        $response->setStatusCode(Response::STATUS_CODE_200);
        $response->buildMeta(0, 0, 0);
        return $this->createResponseByJsonObject([], $headers, $response->getStatusCode());
    }
}