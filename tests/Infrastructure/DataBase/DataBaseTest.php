<?php

namespace Test\Infrastructure\DataBase;

use App\Infrastructure\DataBase\PostgresConnectionFactory;
use PDOException;
use PDO;
use PHPUnit\Framework\TestCase;

class DataBaseTest extends TestCase
{

    public function testReturnConnectionDataBase()
    {
        $dbInstancia = new PostgresConnectionFactory();

        try {
            $connect = $dbInstancia::create();

            $this->assertInstanceOf(PDO::class, $connect); 
            $this->assertTrue($connection->query('SELECT 1')->fetchColumn() === 1);
        
        } catch (PDOException $e) {
            $this->fail('Fail in conect database', $e->getMessage());
        }
    }
    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }
}