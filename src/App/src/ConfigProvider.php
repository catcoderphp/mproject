<?php

declare(strict_types=1);

namespace App;

use App\Dao\ClientDao;
use App\Dao\RangeDao;
use App\Factory\ClientDaoFactory;
use App\Factory\ClientHandlerFactory;
use App\Factory\ClientServiceFactory;
use App\Factory\DataProviderHandlerFactory;
use App\Factory\EMTransactionsFactory;
use App\Factory\RangeDaoFactory;
use App\Handler\ClientHandler;
use App\Handler\DataProviderHandler;
use App\Service\ClientService;
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
                //service invokable
                ClientService::class => ClientServiceFactory::class,
                // handler invokable
                DataProviderHandler::class => DataProviderHandlerFactory::class,
                ClientHandler::class => ClientHandlerFactory::class,
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
