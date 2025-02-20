<?php

namespace App\Infrastructure\Frameworks\MessageBrokers;

use App\Infrastructure\Interfaces\ConfigKafkaImpl;

class ConfigKafkaFactory
{
    public static function create(): ConfigKafkaImpl
    {
        $key  = 'metadata.broker.list';
        $host = '192.168.100.3:9092';
 
        return new ConfigKafkaMessageBroker($key, $host);
    }
}
