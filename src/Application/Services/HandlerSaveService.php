<?php

namespace App\Application\Services;

use App\Application\Factories\CustomerCommandFactory;
use App\Application\Interfaces\CustomerCommandImpl;
use App\Application\Interfaces\HandlerSaveServiceImpl;

class HandlerSaveService implements HandlerSaveServiceImpl
{
    private CustomerCommandImpl $commandRepository;

    public function __construct(private readonly CustomerCommandFactory $customerCommand)
    {
        $this->commandRepository = $customerCommand::create();
    }

    public function handler($payload)
    {
        var_dump($payload);
        // $responseRepository = $this->commandRepository->save($payload);
    }
}
