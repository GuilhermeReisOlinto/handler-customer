<?php

namespace App\Application\Interfaces;

interface ContactInfoQueryImpl
{
    public function findByIdCustomer(string $id);
}
