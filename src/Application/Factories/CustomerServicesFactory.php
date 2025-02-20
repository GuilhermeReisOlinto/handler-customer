<?php

namespace App\Application\Factories;

use App\Application\Interfaces\HandlerSaveServiceImpl;
use App\Application\Services\HandlerSaveService;
use App\Infrastructure\Frameworks\MessageBrokers\ConfigKafkaFactory;

class CustomerServicesFactory
{
    public static function create(): HandlerSaveServiceImpl
    {
        $command = new CustomerCommandFactory();
        $query = new CustomerQueryFactory();
        $kafka = new ConfigKafkaFactory();

        return new HandlerSaveService($command, $query, $kafka);
    }
}
