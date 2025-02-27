<?php

namespace App\Application\Command;

use App\Application\Interfaces\ContactInfoCommandImpl;
use App\Infrastructure\DataBase\PostgresConnectionFactory;
use PDO;

class ContactInfoCommand implements ContactInfoCommandImpl
{
    private PDO $connect;

    public function __construct(private readonly PostgresConnectionFactory $pgConnect)
    {
        $pgConnect = PostgresConnectionFactory::create();
        $this->connect = $pgConnect->getConnection();
    }

    public function save($dataContact): void
    {
        $sql = "INSERT INTO customer_contact_info 
        (phone_number, phone_number_alternative, email, email_alternative, fathers_name, fathers_phone, mothers_name, mothers_phone, customer_id)
        VALUES (:phone_number, :phone_number_alternative, :email, :email_alternative, :fathers_name, :fathers_phone, :mothers_name, :mothers_phone, :customer_id)";

        $stmt = $this->connect->prepare($sql);

        $stmt->execute([
            ":phone_number"             => $dataContact['phone_number'],
            ":phone_number_alternative" => $dataContact['phone_number_alternative'],
            ":email"                    => $dataContact['email'],
            ":email_alternative"        => $dataContact['email_alternative'],
            ":fathers_name"             => $dataContact['fathers_name'],
            ":fathers_phone"            => $dataContact['fathers_phone'],
            ":mothers_name"             => $dataContact['mothers_name'],
            ":mothers_phone"            => $dataContact['mothers_phone'],
            ":customer_id"              => $dataContact['customer_id']
        ]);
    }

    public function saveLocalizations($dataContact): void
    {
        $sql = "INSERT INTO customer_localization_info 
        (street, city, state, country, zip_code, number_house, complement, customer_id)
        VALUES (:street, :city, :state, :country, :zip_code, :number_house, :complement, :customer_id)";

        $stmt = $this->connect->prepare($sql);

        $stmt->execute([
            ":street"       => $dataContact['street'],
            ":city"         => $dataContact['city'],
            ":state"        => $dataContact['state'],
            ":country"      => $dataContact['country'],
            ":zip_code"     => $dataContact['zip_code'],
            ":number_house" => $dataContact['number_house'],
            ":complement"   => $dataContact['complement'],
            ":customer_id"  => $dataContact['customer_id']
        ]);
    }
}
