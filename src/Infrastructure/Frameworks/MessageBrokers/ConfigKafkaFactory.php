<?php

namespace App\Infrastructure\Frameworks\MessageBrokers;

class ConfigKafkaFactory
{
    public static function create(): ConfigKafkaImpl
    {
        $key  = 'metadata.broker.list';
        $host = 'kafka:9092';
 
        return new ConfigKafkaMessageBroker($key, $host);
    }
}