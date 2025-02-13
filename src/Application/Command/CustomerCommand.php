<?php

namespace App\Application\Command;

use App\Application\Interfaces\CustomerCommandImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;
use PDO;

class CustomerCommand implements CustomerCommandImpl
{
    private PDO $connect;

    public function __construct(private readonly PostgresConnectionFactory $pgConnect)
    {
        $pgConnect = PostgresConnectionFactory::create();
        $this->connect = $pgConnect->getConnection();
    }

    public function save($customerData): string
    {

        $sql = "INSERT INTO data_customer (name, document_number, nationality, type_document, date_birth) 
        VALUES (:name, :document_number, :nationality,:type_document, :date_birth) RETURNING data_customer_id";

        $stmt = $this->connect->prepare($sql);

        $stmt->execute([
            ':name'            => $customerData['name'],
            ':document_number' => $customerData['document_number'],
            ':nationality'     => $customerData['nationality'],
            ':type_document'   => $customerData['type_document'],
            ':date_birth'      => $customerData['date_birth'],
        ]);

        return $stmt->fetchColumn();
    }
}
