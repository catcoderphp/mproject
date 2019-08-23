<?php


namespace App\Service;


use App\Dao\ClientDao;
use App\Entity\ClientEntity;
use App\Model\Client;
use App\Model\ResponseHandler;
use Zend\Http\Response;

class ClientService
{
    /**
     * @var ClientDao
     */
    private $clientDao;

    public function __construct(ClientDao $clientDao)
    {
        $this->clientDao = $clientDao;
    }

    public function getById($id) : ?ResponseHandler
    {
        $client = $this->clientDao->getById($id);
        $responseHandler = new ResponseHandler();
        if ($client instanceof ClientEntity) {
            $clientModel = new Client();
            $responseHandler->setData($clientModel->mapObject($client));
            $responseHandler->setStatusCode(Response::STATUS_CODE_200);
            $responseHandler->setError(false);
            $responseHandler->buildMeta(1,1,1);
            $responseHandler->setMessage("Client was found");
        } else {
            $responseHandler->notFound();
        }

        return $responseHandler;
    }

    public function save($data) : ?ResponseHandler
    {
        $clientEntity = new ClientEntity();
        $clientEntity->setEmail($data["email"]);
        $clientEntity->setName($data["name"]);
        $clientEntity->setLastname($data["lastname"]);
        $clientEntity->setPhone($data["phone"]);
        $clientEntity->setVisible($data["visible"]);
        $clientEntity->setRange($data["range_id"]);
        $saved = $this->clientDao->save($clientEntity);
        $responseHandler = new ResponseHandler();

        if ($saved instanceof ClientEntity)
        {
            $client = new Client();
            $responseHandler->setData($client->mapObject($clientEntity));
            $responseHandler->setError(false);
            $responseHandler->setMessage("New client stored");
            $responseHandler->buildMeta(1,1,1);
            $responseHandler->setStatusCode(Response::STATUS_CODE_202);
        } else
        {
            $responseHandler->notFound();
        }

        return $responseHandler;
    }
}