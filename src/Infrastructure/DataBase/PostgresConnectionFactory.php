<?php

namespace App\Infrastructure\DataBase;

use App\Infrastructure\Interfaces\PostgresConnectionImpl;

class PostgresConnectionFactory
{

    public static function create(): PostgresConnectionImpl
    {
        $dsn = 'pgsql:host=localhost;dbname=customers';
        $password = 'postgres';
        $user = 'postgres';

        return new PostgresConnection($dsn, $user, $password);
    }
}
