<?php


namespace App\Handler;


use App\Dao\MembershipDao;
use App\Model\ResponseHandler;
use App\RestDispatchTrait;
use App\Service\CollaboratorService;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Http\Response;

class CollaboratorHandler implements RequestHandlerInterface
{
    use RestDispatchTrait;
    private $collaboratorService;
    /**
     * @var HalResponseFactory
     */
    private $responseFactory;
    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;

    private $membershipDao;

    private $response;

    public function __construct(
        CollaboratorService $collaboratorService,
        HalResponseFactory $responseFactory,
        ResourceGenerator $resourceGenerator,
        MembershipDao $membershipDao
    )
    {
        $this->collaboratorService = $collaboratorService;
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->membershipDao = $membershipDao;
        $this->response = new ResponseHandler();
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Zend\Diactoros\Response\JsonResponse
     */
    public final function get(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();

        $response = new ResponseHandler();

        if (isset($params["token"])) {
            $this->actions("token", $params["token"]);
        }
        return $this->createResponseByJsonObject($this->response, [], $this->response->getStatusCode());
    }

    private function actions($action, $param)
    {
        $response = $this->response;
        $actions = [
            "token" => function () use (&$param, $response) {

                $collaboratorSession = $this->collaboratorService->getByToken($param);
                if (!is_null($collaboratorSession)) {
                    $response->setData($collaboratorSession);
                    $response->setError(false);
                    $response->setMessage("Session active");
                    $response->setStatusCode(Response::STATUS_CODE_200);
                    $response->buildMeta(1, 1, 1);
                } else {
                    $response->notFound();
                }
            },
            "membership_by_collaborator" => function () use (&$param, &$response) {
            }
        ];
        $this->response = $response;
        $actions[$action]();
    }

    /**
     * @param ServerRequestInterface $request
     * Register collaborator
     */
    public final function post(ServerRequestInterface $request)
    {
        $responseHandler = $this->collaboratorService->save($request);
        return $this->createResponseByJsonObject($responseHandler, [], $responseHandler->getStatusCode());
    }
}