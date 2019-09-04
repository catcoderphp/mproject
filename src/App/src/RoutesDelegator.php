<?php
/**
 * Created by PhpStorm.
 * User: azu
 * Date: 3/21/19
 * Time: 10:44 AM
 */

namespace App;


use App\Handler\ClientHandler;
use App\Handler\CollaboratorHandler;
use App\Handler\CollaboratorLoginHandler;
use App\Handler\DataProviderHandler;
use App\Handler\UserRootHandler;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;
use Zend\Expressive\Router\Middleware\ImplicitOptionsMiddleware;

class RoutesDelegator
{
    /**
     * @param ContainerInterface $container
     * @param string $serviceName Name of the service being created.
     * @param callable $callback Creates and returns the service.
     * @return Application
     */
    public function __invoke(ContainerInterface $container, $serviceName, callable $callback)
    {
        /** @var $app Application */
        $app = $callback();

        $app->route("/provider",
            [DataProviderHandler::class], ["GET"]
        );

        $app->route("/clients", [
            ImplicitOptionsMiddleware::class,
            BodyParamsMiddleware::class,
            ClientHandler::class
        ], [
            "GET",
            "POST"
        ]);

        $app->route("/collaborators", [
            ImplicitOptionsMiddleware::class,
            BodyParamsMiddleware::class,
            CollaboratorHandler::class
        ], [
            "GET",
            "POST"
        ]);

        $app->route("/user-login", [
            ImplicitOptionsMiddleware::class,
            BodyParamsMiddleware::class,
            UserRootHandler::class
        ], ["POST"]);

        $app->route("/collaborator-login", [
            ImplicitOptionsMiddleware::class,
            BodyParamsMiddleware::class,
            CollaboratorLoginHandler::class
        ], ["POST"]);

        return $app;
    }
}