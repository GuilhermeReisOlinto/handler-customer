<?php

namespace App\Infrastructure\Frameworks\Controllers;

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Interfaces\CustomerCommandImpl;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CustomerInController
{
    private CustomerCommandImpl $repository;

    public function __construct(private readonly CustomerCommandFactory $customerCommand)
    {
        $this->repository = $customerCommand::create();
    }

    public function registerRoutes($app)
    {
        $app->get('/', function (Request $request, Response $response, $args) {
            $response->getBody()->write('hello word');
            return $response;
        });

        $app->post('/customer', function (Request $request, Response $response) {

            $bodyRequest = $request->getBody();
            $payload = json_decode($bodyRequest, true);
            $resp = $this->repository->save($payload);

            var_dump($resp);
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        });
    }
}
