<?php

namespace Test\Infrastructure;

use App\Infrastructure\DataBase\PostgresConnection;
use PDOException;
use PDO;
use PHPUnit\Framework\TestCase;

class DataBaseTest extends TestCase
{
    private string $dsn = 'pgsql:host=localhost;port=5432;dbname=customers';
    private string $password = 'postgres';
    private string $user = 'postgres';

    public function testReturnConnectionDataBase()
    {
        $dbInstancia = new PostgresConnection($this->dsn, $this->password, $this->user);

        try {
            $connect = $dbInstancia->getConnection();

            $this->assertInstanceOf(PDO::class, $connect); 
            $this->assertTrue($connect->query('SELECT 1')->fetchColumn() === 1);
        } catch (PDOException $e) {
            $this->fail('Fail in conect database', $e->getMessage());
        }
    }
}