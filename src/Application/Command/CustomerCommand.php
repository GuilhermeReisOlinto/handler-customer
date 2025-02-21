<?php

namespace App\Application\Command;

use App\Application\Interfaces\CustomerCommandImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;
use Exception;
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
        try {
            $this->connect->beginTransaction();

            $sql = "INSERT INTO customer_data (name, document_number, nationality, type_document, date_birth) 
            VALUES (:name, :document_number, :nationality,:type_document, :date_birth) RETURNING customer_id";

            $stmt = $this->connect->prepare($sql);

            $stmt->execute([
                ':name'            => $customerData['name'],
                ':document_number' => $customerData['document_number'],
                ':nationality'     => $customerData['nationality'],
                ':type_document'   => $customerData['type_document'],
                ':date_birth'      => $customerData['date_birth'],
            ]);

            $this->connect->commit();
            return $stmt->fetchColumn();
        } catch (Exception $e) {
            $this->connect->rollBack();

            return $error = [
                'error' => true,
                'type'  => get_class($e),
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
    }
}
