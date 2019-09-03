<?php


namespace App\Service;


use App\Dao\UserRootDao;
use App\Entity\UserRootEntity;
use App\Entity\UserSession;
use App\Model\ResponseHandler;
use App\Validators\UserRootValidator;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;
use Zend\Http\Response;

/**
 * Class UserRootService
 * @package App\Service
 */
class UserRootService
{
    /**
     * @var UserRootDao
     */
    private $userRootDao;

    public function __construct(UserRootDao $userRootDao)
    {
        $this->userRootDao = $userRootDao;
    }

    public function login(ServerRequestInterface $request) : ResponseHandler
    {
        $userRootValidator = new UserRootValidator();
        $responseHandler = new ResponseHandler();
        if ($userRootValidator->validate($request)) {
            $data = $request->getParsedBody();
            $email = $data["email"];
            $passwd = $data["password"];
            $login = $this->userRootDao->login($email, $passwd);
            if ($login instanceof UserRootEntity) {
                $session = $this->userRootDao->createSession($login);
                if ($session instanceof UserSession)
                {
                    $responseHandler->setMessage("Login successful");
                    $responseHandler->setError(false);
                    $responseHandler->buildMeta(1,1,1);
                    $responseHandler->setStatusCode(Response::STATUS_CODE_200);
                    $loginData = [
                        "token" => $session->getToken(),
                        "ttl" => $session->getTtl(),
                        "email" => $login->getEmail(),
                        "username" => $login->getUsername()
                    ];
                    $responseHandler->setData($loginData);
                }
            } else {
                $responseHandler->setMessage("User/password are invalid");
                $responseHandler->setError(true);
                $responseHandler->setStatusCode(Response::STATUS_CODE_401);
                $responseHandler->setData($request->getParsedBody());
                $responseHandler->buildMeta(0,0,0);
            }
        } else {
            $responseHandler->setStatusCode(Response::STATUS_CODE_400);
            $responseHandler->setData($userRootValidator->messages);
            $responseHandler->setError(true);
            $responseHandler->setMessage("Bad request");
            $responseHandler->buildMeta(0,0,0);
        }

        return $responseHandler;
    }
}