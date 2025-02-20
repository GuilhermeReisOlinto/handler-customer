<?php

namespace App\Infrastructure\Frameworks\MessageBrokers;

use App\Infrastructure\Interfaces\ConfigKafkaImpl;
use RdKafka;

class ConfigKafkaMessageBroker implements ConfigKafkaImpl
{
    private $topic;
    private $produce;

    public function __construct(string $key, string $host)
    {
        $conf = new RdKafka\Conf();
        $conf->set($key, $host);

        $this->produce = new RdKafka\Producer($conf);
        $this->topic = $this->produce->newTopic('Customer-created');
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function sendMessage($message)
    {
        $this->topic->produce(RD_KAFKA_PARTITION_UA, 0, json_encode($message));
        $this->produce->poll(0);
    }
    
    private function __destruct()
    {
        $this->produce->flush(1000);
    }
}
