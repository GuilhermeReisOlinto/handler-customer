<?php

namespace App\Application\Factories;

use App\Application\Interfaces\ContactInfoQueryImpl;
use App\Application\Interfaces\CustomerQueryImpl;
use App\Application\Query\ContactInfoQuery;
use App\Application\Query\CustomerQuery;
use App\Infrastructure\DataBase\PostgresConnectionFactory;

class CustomerQueryFactory
{
    public static function create(): CustomerQueryImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new CustomerQuery($pgConnect);
    }

    public function createContact(): ContactInfoQueryImpl
    {
        $pgConnect = new PostgresConnectionFactory();
        return new ContactInfoQuery($pgConnect);
    }
}
