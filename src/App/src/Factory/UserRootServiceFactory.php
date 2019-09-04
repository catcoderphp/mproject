<?php


namespace App\Factory;


use App\Dao\UserRootDao;
use App\Service\UserRootService;
use Psr\Container\ContainerInterface;

class UserRootServiceFactory
{
    public function __invoke(ContainerInterface $container): UserRootService
    {
        $userRootDao = $container->get(UserRootDao::class);
        return new UserRootService($userRootDao);
    }
}