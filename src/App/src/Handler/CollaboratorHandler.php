<?php


namespace App\Handler;


use App\Dao\MembershipDao;
use App\RestDispatchTrait;
use App\Service\CollaboratorService;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;

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

    public final function get()
    {
        $collaborator = $this->collaboratorService->getById(1);

        $membership = $this->membershipDao->getById(4);


        if ($collaborator->getMemberships()->count()) {
            $collaborator->getMemberships()->add($membership);
        } else {
            $persistenceObject = new ArrayCollection();
            $persistenceObject->add($membership);
            $collaborator->setMemberships($persistenceObject);
        }

        $this->collaboratorService->save($collaborator);
        $membershipResponse = [];
        foreach ($collaborator->getMemberships() as $membership) {
            $membershipResponse[] = [
                "id" => $membership->getId(),
                "name" => $membership->getName(),
            ];
        }
        $collaboratorResponse = [
            "id" => $collaborator->getId(),
            "memberships" => $membershipResponse,
            "email" => $collaborator->getEmail()
        ];
        return $this->createResponseByJsonObject($collaboratorResponse, [], 200);
    }
}