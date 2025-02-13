<?php

namespace App\Application\Interfaces;

interface CustomerQueryImpl
{
    public function show();
    public function findByDocNumber(string $documentNumber);
}
