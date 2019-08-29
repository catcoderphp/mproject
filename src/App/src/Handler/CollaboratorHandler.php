<?php


namespace App\Handler;


use App\Dao\MembershipDao;
use App\Entity\CollaboratorEntity;
use App\Model\Collaborator;
use App\Model\ResponseHandler;
use App\RestDispatchTrait;
use App\Service\CollaboratorService;
use App\Validators\CollaboratorValidator;
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

    /**
     * @param ServerRequestInterface $request
     * Register collaborator
     */
    public final function post(ServerRequestInterface $request)
    {
        $collaboratorValidator = new CollaboratorValidator();
        $validation = $collaboratorValidator->validate($request);
        $responseHandler = new ResponseHandler();

        if ($validation) {
            $parsedPost = $request->getParsedBody();
            $uniquePassword = md5(trim($parsedPost["password"]) . trim($parsedPost["email"]));
            $collaboratorEntity = new CollaboratorEntity();
            $collaboratorEntity->setEmail($parsedPost["email"]);
            $collaboratorEntity->setName($parsedPost["name"]);
            $collaboratorEntity->setLastname($parsedPost["lastname"]);
            $collaboratorEntity->setEmail(trim($parsedPost["email"]));
            $collaboratorEntity->setPassword($uniquePassword);
            $collaboratorEntity->setPhone($parsedPost["phone"]);

            $this->collaboratorService->save($collaboratorEntity);
            $collaborator = new Collaborator();
            $responseHandler->setData($collaborator->map($collaboratorEntity));
            $responseHandler->setStatusCode(Response::STATUS_CODE_200);
            $responseHandler->setMessage("Collaborator Created");
            $responseHandler->setError(false);
            $responseHandler->buildMeta(1, 1, 1);

        } else {
            $responseHandler->setError(true);
            $responseHandler->setData($collaboratorValidator->messages);
            $responseHandler->setStatusCode(Response::STATUS_CODE_400);
            $responseHandler->setMessage("Bad request");
            $responseHandler->buildMeta(1, 1, 1);
        }

        return $this->createResponseByJsonObject($responseHandler, [], $responseHandler->getStatusCode());
    }
}