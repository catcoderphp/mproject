<?php

declare(strict_types=1);

namespace App;

use App\Dao\ClientDao;
use App\Dao\CollaboratorDao;
use App\Dao\MembershipDao;
use App\Dao\RangeDao;
use App\Dao\UserRootDao;
use App\Factory\ClientDaoFactory;
use App\Factory\ClientHandlerFactory;
use App\Factory\ClientServiceFactory;
use App\Factory\CollaboratorDaoFactory;
use App\Factory\CollaboratorHandlerFactory;
use App\Factory\CollaboratorLoginFactory;
use App\Factory\CollaboratorServiceFactory;
use App\Factory\DataProviderHandlerFactory;
use App\Factory\EMTransactionsFactory;
use App\Factory\MembershipDaoFactory;
use App\Factory\RangeDaoFactory;
use App\Factory\UserRootDaoFactory;
use App\Factory\UserRootHandlerFactory;
use App\Factory\UserRootServiceFactory;
use App\Handler\ClientHandler;
use App\Handler\CollaboratorHandler;
use App\Handler\CollaboratorLoginHandler;
use App\Handler\DataProviderHandler;
use App\Handler\UserRootHandler;
use App\Service\ClientService;
use App\Service\CollaboratorService;
use App\Service\UserRootService;
use App\Utils\EMTransactions;
use Zend\Expressive\Application;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates' => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
            ],
            'factories' => [
                //dao invokable
                ClientDao::class => ClientDaoFactory::class,
                RangeDao::class => RangeDaoFactory::class,
                MembershipDao::class => MembershipDaoFactory::class,
                CollaboratorDao::class => CollaboratorDaoFactory::class,
                UserRootDao::class => UserRootDaoFactory::class,
                //service invokable
                ClientService::class => ClientServiceFactory::class,
                CollaboratorService::class => CollaboratorServiceFactory::class,
                UserRootService::class => UserRootServiceFactory::class,
                // handler invokable
                DataProviderHandler::class => DataProviderHandlerFactory::class,
                ClientHandler::class => ClientHandlerFactory::class,
                CollaboratorHandler::class => CollaboratorHandlerFactory::class,
                UserRootHandler::class => UserRootHandlerFactory::class,
                CollaboratorLoginHandler::class => CollaboratorLoginFactory::class,
                //utils invokable
                EMTransactions::class => EMTransactionsFactory::class
            ],
            'delegators' => [
                Application::class => [
                    RoutesDelegator::class
                ]
            ]

        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app' => [__DIR__ . '/../templates/app'],
                'error' => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
