<?php

namespace App\Infrastructure\Factories;

use App\Infrastructure\Frameworks\MessageBrokers;

class ConfigKafkaFactory
{
    public static function create()
    {
        $key  = 'metadata.broker.list';
        $host = 'kafka:9092';
 
        return new ConfigKafkaMessageBroker($key, $host);
    }
}