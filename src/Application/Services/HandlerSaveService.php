<?php

namespace App\Application\Services;

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Factories\CustomerQueryFactory;
use App\Application\Interfaces\ContactInfoCommandImpl;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Application\Interfaces\CustomerQueryImpl;
use App\Application\Interfaces\HandlerSaveServiceImpl;
use App\Infrastructure\Frameworks\MessageBrokers\ConfigKafkaFactory;
use App\Infrastructure\Interfaces\ConfigKafkaImpl;

class HandlerSaveService implements HandlerSaveServiceImpl
{
    private CustomerCommandImpl $commandRepository;
    private CustomerQueryImpl $queryRepository;
    private ContactInfoCommandImpl $commandContactRepository;
    private ConfigKafkaImpl $topicKafka;

    public function __construct(
        private readonly CustomerCommandFactory $customerCommand,
        private readonly CustomerQueryFactory $customerQuery,
        private readonly ConfigKafkaFactory $configKafka,
    ) {
        $this->commandRepository = $customerCommand::create();
        $this->queryRepository = $customerQuery::create();
        $this->commandContactRepository = $customerCommand::createContact();
        $this->topicKafka = $configKafka::create();
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

        if (!$responseRepository) {
            return $message = 'Not create customer, rollback execute';
        }

        $this->saveContactInfo($payload['customer_contact_info'], $responseRepository);
        $this->saveLocalizationInfo($payload['customer_localization_info'], $responseRepository);

        $this->topicKafka->sendMessage('enviar o que for necessario para o kafka');

    }

    private function validDocumentNumber(string $documentNumber)
    {
        return $this->queryRepository->findByDocNumber($documentNumber);
    }

    private function saveContactInfo($contactInfo, string $responseRepository)
    {
        $contactInfo['customer_id'] = $responseRepository;

        $this->commandContactRepository->save($contactInfo);
    }

    private function saveLocalizationInfo($localizationInfo, string $responseRepository)
    {
        $localizationInfo['customer_id'] = $responseRepository;

        $this->commandContactRepository->saveLocalizations($localizationInfo);
    }
}
