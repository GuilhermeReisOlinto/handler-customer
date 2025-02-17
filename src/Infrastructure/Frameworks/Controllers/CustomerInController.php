<?php

namespace App\Infrastructure\Frameworks\Controllers;

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Application\Interfaces\CustomerQueryImpl;
use App\Application\Factories\CustomerQueryFactory;
use App\Application\Factories\CustomerServicesFactory;
use App\Application\Interfaces\HandlerSaveServiceImpl;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CustomerInController
{
    private CustomerQueryImpl $queryRepository;
    private HandlerSaveServiceImpl $service;

    public function __construct(
        private readonly CustomerQueryFactory $customerQuery,
        private readonly CustomerServicesFactory $customerService
    ) {
        $this->queryRepository = $customerQuery::create();
        $this->service = $customerService::create();
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
            $serviceResp = $this->service->handler($payload);


            var_dump($serviceResp);
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
