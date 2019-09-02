<?php


namespace App\Factory;


use App\Handler\UserRootHandler;
use Psr\Container\ContainerInterface;

class UserRootHandlerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new UserRootHandler();
    }
}