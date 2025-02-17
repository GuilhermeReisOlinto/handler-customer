<?php

namespace App\Application\Query;

use App\Application\Interfaces\ContactInfoQueryImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;
use Exception;
use PDO;

class ContactInfoQuery implements ContactInfoQueryImpl
{
    private PDO $connect;

    public function __construct(private readonly PostgresConnectionFactory $pgConnect)
    {
        $pgConnect = $this->pgConnect::create();
        $this->connect = $pgConnect->getConnection();
    }

    public function findByIdCustomer(string $id)
    {
        $sql = "SELECT * FROM customer_contact_info WHERE data_customer_id = :id";

        $stmt = $this->connect->prepare($sql);


        if (!$stmt) {
            throw new Exception("Error in prepare consult query");
        }

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
