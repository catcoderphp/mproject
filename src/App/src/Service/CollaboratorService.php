<?php


namespace App\Service;


use App\Dao\CollaboratorDao;
use App\Entity\CollaboratorEntity;
use App\Entity\MembershipEntity;
use App\Model\Collaborator;
use App\Model\ResponseHandler;
use Zend\Http\Response;

class CollaboratorService
{
    private $collaboratorDao;
    private $response;

    public function __construct(CollaboratorDao $collaboratorDao)
    {
        $this->collaboratorDao = $collaboratorDao;
        $this->response = new ResponseHandler();
    }

    public function getById($id)
    {
        $collaboratorEntity = $this->collaboratorDao->getById($id);
        if ($collaboratorEntity instanceof CollaboratorEntity) {
            $membershipResponse = [];
            $collaborator = new Collaborator();
            $collaboratorResponse = $collaborator->map($collaboratorEntity);

            $this->response->setError(false);
            $this->response->setMessage("Collaborator found");
            $this->response->setStatusCode(Response::STATUS_CODE_200);
            $this->response->setData($collaboratorResponse);
            $this->response->buildMeta(1, 1, 1);
        } else {
            $this->response->notFound();
        }

        return $this->response;
    }

    public function save($collaboratorEntity)
    {
        return $this->collaboratorDao->save($collaboratorEntity);
    }

    public function haveMembership($membership_id, $collaborator_id)
    {
        return $this->collaboratorDao->haveMembership($membership_id, $collaborator_id);
    }

    public function addMembership(MembershipEntity $membership, CollaboratorEntity $collaborator)
    {
        return $this->collaboratorDao->addMembership($membership, $collaborator);
    }
}