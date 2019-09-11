<?php


namespace App\Service;


use App\Dao\CollaboratorDao;
use App\Entity\CollaboratorEntity;
use App\Entity\CollaboratorSessionEntity;
use App\Entity\MembershipEntity;
use App\Model\Collaborator;
use App\Model\ResponseHandler;
use App\Model\Session;
use App\Validators\CollaboratorLoginValidator;
use App\Validators\CollaboratorValidator;
use Psr\Http\Message\ServerRequestInterface;
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

    public function getByToken($token)
    {
        $session = $this->collaboratorDao->getByToken($token);
        if ($session instanceof CollaboratorSessionEntity) {
            $sessionMap = new Session();
            return $sessionMap->map($session);
        }

        return null;
    }

    public function save(ServerRequestInterface $request): ResponseHandler
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

            $this->collaboratorDao->save($collaboratorEntity);
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

        return $responseHandler;
    }

    public function login(ServerRequestInterface $request): ResponseHandler
    {
        $collaboratorLoginValidator = new CollaboratorLoginValidator();
        $validate = $collaboratorLoginValidator->validate($request);
        $responseHandler = new ResponseHandler();
        if ($validate) {
            $data = $request->getParsedBody();
            $email = $data["email"];
            $passwd = $data["password"];


            $login = $this->collaboratorDao->login($email, $passwd);
            if ($login instanceof CollaboratorEntity) {
                $session = $this->collaboratorDao->createSession($login);
                if ($session instanceof CollaboratorSessionEntity) {
                    $responseHandler->setMessage("Login successful");
                    $responseHandler->setError(false);
                    $responseHandler->buildMeta(1, 1, 1);
                    $responseHandler->setStatusCode(Response::STATUS_CODE_200);
                    $loginData = [
                        "token" => $session->getToken(),
                        "ttl" => $session->getTtl(),
                        "email" => $login->getEmail(),
                        "name" => $login->getName()
                    ];
                    $responseHandler->setData($loginData);
                }
            } else {
                $responseHandler->setMessage("User/password are invalid");
                $responseHandler->setError(true);
                $responseHandler->setStatusCode(Response::STATUS_CODE_401);
                $responseHandler->setData($request->getParsedBody());
                $responseHandler->buildMeta(0, 0, 0);
            }
        } else {
            $responseHandler->setStatusCode(Response::STATUS_CODE_400);
            $responseHandler->setData($collaboratorLoginValidator->messages);
            $responseHandler->setError(true);
            $responseHandler->setMessage("Bad request");
            $responseHandler->buildMeta(0, 0, 0);
        }
        return $responseHandler;
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