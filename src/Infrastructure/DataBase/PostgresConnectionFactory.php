<?php

namespace App\Infrastructure\DataBase;

use App\Infrastructure\Interfaces\PostgresConnectionImpl;

class PostgresConnectionFactory
{

    public static function create(): PostgresConnectionImpl
    {
        $dsn = 'pgsql:host=localhost;port=5432;dbname=customers';
        $password = 'postgres';
        $user = 'postgres';

        return new PostgresConnection($dsn, $user, $password);
    }
}
