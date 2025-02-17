<?php

namespace App\Application\Interfaces;

interface ContactInfoCommandImpl
{
    public function save($dataContact);
    public function saveLocalizations($dataContact);
}
