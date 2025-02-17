<?php

namespace App\Application\Services;

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Factories\CustomerQueryFactory;
use App\Application\Interfaces\ContactInfoCommandImpl;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Application\Interfaces\CustomerQueryImpl;
use App\Application\Interfaces\HandlerSaveServiceImpl;

class HandlerSaveService implements HandlerSaveServiceImpl
{
    private CustomerCommandImpl $commandRepository;
    private CustomerQueryImpl $queryRepository;
    private ContactInfoCommandImpl $commandContactRepository;

    public function __construct(
        private readonly CustomerCommandFactory $customerCommand,
        private readonly CustomerQueryFactory $customerQuery
    ) {
        $this->commandRepository = $customerCommand::create();
        $this->queryRepository = $customerQuery::create();
        $this->commandContactRepository = $customerCommand::createContact();
    }

    public function handler($payload)
    {
        if (!$payload['customer_info']) {
            return $message = 'Customer data not-found';
        }

        $resp = $this->validDocumentNumber($payload['customer_info']['document_number']);

        if ($resp) {
            return $message = 'Customer already exists';
        }

        $responseRepository = $this->commandRepository->save($payload['customer_info']);

        if ($responseRepository) {
            $this->saveContactInfo($payload['customer_contact_info']);
        }
    }

    private function validDocumentNumber(string $documentNumber)
    {
        return $this->queryRepository->findByDocNumber($documentNumber);
    }

    private function saveContactInfo($contactInfo)
    {
        $this->commandContactRepository->save($contactInfo);
    }
}
