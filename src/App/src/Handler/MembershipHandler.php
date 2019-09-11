<?php


namespace App\Handler;


use App\Dao\CollaboratorDao;
use App\Entity\CollaboratorSessionEntity;
use App\Model\ResponseHandler;
use App\RestDispatchTrait;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Http\Response;

class MembershipHandler implements RequestHandlerInterface
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
     * @var CollaboratorDao
     */
    private $collaboratorDao;

    public function __construct(
        ResourceGenerator $resourceGenerator,
        HalResponseFactory $responseFactory,
        CollaboratorDao $collaboratorDao)
    {
        $this->resourceGenerator = $resourceGenerator;
        $this->responseFactory = $responseFactory;
        $this->collaboratorDao = $collaboratorDao;
    }

    public function get(ServerRequestInterface $request)
    {
        $params = $request->getQueryParams();
        $responseHandler = new ResponseHandler();
        if (isset($params["token"]) && isset($params["membership_id"])) {

            $collaborator = $this->collaboratorDao->getByToken($params["token"]);
            if ($collaborator instanceof CollaboratorSessionEntity) {
                $collaborator = $collaborator->getCollaborator();
                $memberships = $collaborator->getMemberships();
                $membershipResponse = [];
                if (!is_null($memberships)) {
                    foreach ($memberships as $membership) {
                        if ($membership->getId() == $params["membership_id"]) {
                            $membershipResponse = [
                                "name" => $membership->getName(),
                                "active_until" => $membership->getSuscription()->getTtl(),
                                "process_status" => []
                            ];
                            $clients = $membership->getRange()->getClients();
                            if (!is_null($clients)) {
                                foreach ($clients as $client) {
                                    $membershipResponse["clients"][] = [
                                        "name" => $client->getName(),
                                        "lastname" => $client->getLastname(),
                                        "email" => $client->getEmail(),
                                    ];
                                }
                            }
                        }
                    }
                    $responseHandler->setStatusCode(Response::STATUS_CODE_200);
                    $responseHandler->setMessage("Clients on membership ");
                    $responseHandler->setError(false);
                    $responseHandler->setData($membershipResponse);
                    $responseHandler->buildMeta(1, 1, 1);
                }
            } else {
                $responseHandler->notFound();
            }
        } else {
            $responseHandler->notFound();
        }
        return $this->createResponseByJsonObject($responseHandler, [], $responseHandler->getStatusCode());
    }
}