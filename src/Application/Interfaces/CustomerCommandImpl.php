<?php

namespace App\Application\Interfaces;

interface CustomerCommandImpl
{
    public function save($customerData): string;
}
