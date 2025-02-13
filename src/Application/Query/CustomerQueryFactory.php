<?php

namespace App\Application\Query;

use App\Application\Interfaces\CustomerQueryImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;

class CustomerQueryFactory
{
    public static function create(): CustomerQueryImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new CustomerQuery($pgConnect);
    }
}
