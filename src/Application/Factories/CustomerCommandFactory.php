<?php

namespace App\Application\Factories;

use App\Application\Command\ContactInfoCommand;
use App\Application\Command\CustomerCommand;
use App\Application\Interfaces\ContactInfoCommandImpl;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;

class CustomerCommandFactory
{
    public static function create(): CustomerCommandImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new CustomerCommand($pgConnect);
    }

    public static function createContact(): ContactInfoCommandImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new ContactInfoCommand($pgConnect);
    }
}
