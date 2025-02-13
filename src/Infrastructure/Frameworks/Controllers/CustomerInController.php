<?php

namespace App\Infrastructure\Frameworks\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CustomerInController
{
    public function HandlerCustomer($app)
    {
        $app->get('/', function (Request $request, Response $response, $args) {
            $response->getBody()->write('hello word');
            return $response;
        });
    }
}
