<?php

namespace App\Infrastructure\Interfaces;

interface ConfigKafkaImpl
{
    public function getTopic();
    public function sendMessage($message);
}