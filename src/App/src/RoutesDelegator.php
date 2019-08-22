<?php
/**
 * Created by PhpStorm.
 * User: azu
 * Date: 3/21/19
 * Time: 10:44 AM
 */

namespace App;



use App\Handler\DataProviderHandler;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\Helper\BodyParams\BodyParamsMiddleware;

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
            [DataProviderHandler::class], ["GET"]);

        return $app;
    }
}