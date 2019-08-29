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
    }

    public final function get(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();

        if ((!isset($params["collaborator_id"])) && (!isset($params["membership_id"]))) {
            $response = new ResponseHandler();
            $response->setStatusCode(Response::STATUS_CODE_400);
            $response->setData([
                "collaborator_id" => null,
                "membership_id" => null
            ]);
            $response->setMessage("Parameters is missing");
            $response->setError(true);
            $response->buildMeta(0, 0, 0);
            return $this->createResponseByJsonObject($response, [], $response->getStatusCode());
        } else {
            $response = $this->collaboratorService->getById($params["collaborator_id"]);
        }
        return $this->createResponseByJsonObject($response, [], $response->getStatusCode());
    }
}