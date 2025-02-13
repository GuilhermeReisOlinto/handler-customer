<?php

use App\Infrastructure\Frameworks\Controllers\CustomerInController;
use Slim\App;
use Slim\Factory\AppFactory;

class ApplicationFactory
{
    public static function create()
    {
        $app = AppFactory::create();

        $controller = new CustomerInController();
        $controller->HandlerCustomer($app);

        return $app;
    }
}
