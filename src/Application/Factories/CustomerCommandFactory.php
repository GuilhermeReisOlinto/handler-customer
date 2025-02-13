<?php

namespace App\Application\Factories;

use App\Application\Command\CustomerCommand;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;

class CustomerCommandFactory
{
    public static function create(): CustomerCommandImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new CustomerCommand($pgConnect);
    }
}
