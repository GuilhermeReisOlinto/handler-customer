<?php

use App\Application\Factories\CustomerQueryFactory;
use App\Application\Factories\CustomerServicesFactory;
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
        $service = new CustomerServicesFactory();
        $queryRepository = new CustomerQueryFactory();
        return new CustomerInController($queryRepository, $service);
    }
}
