<?php

namespace App\Application\Factories;

use App\Application\Interfaces\CustomerQueryImpl;
use App\Application\Query\CustomerQuery;
use App\Infrastructure\DataBase\PostgresConnectionFactory;

class CustomerQueryFactory
{
    public static function create(): CustomerQueryImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new CustomerQuery($pgConnect);
    }
}
