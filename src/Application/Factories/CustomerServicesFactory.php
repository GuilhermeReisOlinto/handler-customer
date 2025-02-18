<?php

namespace App\Application\Factories;

use App\Application\Interfaces\HandlerSaveServiceImpl;
use App\Application\Services\HandlerSaveService;

class CustomerServicesFactory
{
    public static function create(): HandlerSaveServiceImpl
    {
        $command = new CustomerCommandFactory();
        $query = new CustomerQueryFactory();
        return new HandlerSaveService($command, $query);
    }
}
