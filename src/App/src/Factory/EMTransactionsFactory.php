<?php


namespace App\Factory;


use App\Utils\EMTransactions;
use Psr\Container\ContainerInterface;

class EMTransactionsFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new EMTransactions();
    }
}