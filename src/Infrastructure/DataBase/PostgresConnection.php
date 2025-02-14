<?php

namespace App\Infrastructure\DataBase;

use App\Infrastructure\Interfaces\PostgresConnectionImpl;
use PDO;

class PostgresConnection implements PostgresConnectionImpl
{
    private PDO $connect;

    public function __construct(
        string $dsn,
        string $password,
        string $user,
    ) {
        $this->connect = new PDO($dsn, $user, $password);

        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(): PDO
    {
        return $this->connect;
    }
}
