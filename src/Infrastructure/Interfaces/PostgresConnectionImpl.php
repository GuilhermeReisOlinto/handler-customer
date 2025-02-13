<?php

namespace App\Infrastructure\Interfaces;

use PDO;

interface PostgresConnectionImpl
{
    public function getConnection(): PDO;
}
