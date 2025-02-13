<?php

namespace App\Application\Query;

use App\Application\Interfaces\CustomerQueryImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;
use Exception;
use PDO;

class CustomerQuery implements CustomerQueryImpl
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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByDocNumber(string $documentNumber)
    {
        $sql = "SELECT * FROM data_customer WHERE document_number = :documentNumber";

        $stmt = $this->connect->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error in prepare consult query");
        }

        $stmt->execute([
            ':documentNumber' => $documentNumber
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
