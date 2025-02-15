<?php

namespace App\Infrastructure\Frameworks\Controllers;

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Application\Interfaces\CustomerQueryImpl;
use App\Application\Factories\CustomerQueryFactory;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CustomerInController
{
    private CustomerCommandImpl $commandRepository;
    private CustomerQueryImpl $queryRepository;

    public function __construct(
        private readonly CustomerCommandFactory $customerCommand,
        private readonly CustomerQueryFactory $customerQuery
    ) {
        $this->commandRepository = $customerCommand::create();
        $this->queryRepository = $customerQuery::create();
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
            $resp = $this->commandRepository->save($payload);

            var_dump($resp);
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        });

        $app->get('/customer', function (Request $request, Response $response) {

            $resp = $this->queryRepository->show();

            $response->getBody()->write(json_encode($resp));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });

        $app->get('/customer/{documentNumber}', function (Request $request, Response $response, array $args) {

            $resp = $this->queryRepository->findByDocNumber($args['documentNumber']);

            $response->getBody()->write(json_encode($resp));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        });
    }
}
