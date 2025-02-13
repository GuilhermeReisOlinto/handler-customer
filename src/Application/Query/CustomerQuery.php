<?php

namespace App\Application\Query;

use App\Infrastructure\DataBase\PostgresConnectionFactory;
use Exception;
use PDO;

class CustomerQuery
{
    private PDO $connect;

    public function __construct(private readonly PostgresConnectionFactory $pgConnect)
    {
        $pgConnect = PostgresConnectionFactory::create();
        $this->connect = $pgConnect->getConnection();
    }

    public function show()
    {
        $sql = "SELECT * FROM data_customer";

        $stmt = $this->connect->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error in prepare consult query");
        }

        $stmt->execute();

        var_dump($stmt);
    }

    public function findByDocNumber(string $documentNumber)
    {

        $sql = "SELECT * FROM data_customer WHERE document_number = :documentNumber";

        $stmt = $this->connect->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error in prepare consult query");
        }

        $stmt->execute([
            ':document_number' => $documentNumber
        ]);

        var_dump($stmt);
    }
}
