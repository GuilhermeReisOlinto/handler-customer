<?php

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Query\CustomerQueryFactory;
use App\Infrastructure\Frameworks\Controllers\CustomerInController;
use Slim\App;
use Slim\Factory\AppFactory;

class ApplicationFactory
{
    public static function create(): App
    {
        $app = AppFactory::create();

        $app->addRoutingMiddleware();
        $app->addErrorMiddleware(true, true, true);

        $controller = self::createDependeciesController();
        $controller->registerRoutes($app);

        return $app;
    }

    public static function createDependeciesController(): CustomerInController
    {
        $commandRepository = new CustomerCommandFactory();
        $queryRepository = new CustomerQueryFactory();
        return new CustomerInController($commandRepository, $queryRepository);
    }
}
