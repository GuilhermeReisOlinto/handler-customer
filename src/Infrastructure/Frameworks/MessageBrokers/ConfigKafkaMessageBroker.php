<?php

namespace App\Infrastructure\Frameworks\MessageBrokers;

use RdKafka;

class ConfigKafkaMessageBroker
{
    private $topic;

    public function __construct(string $key, string $host)
    {
        $conf = new RdKafka\Conf();
        $conf->set($key, $host);

        $produce = new Producer($conf);
        $this->topic = $produce->newTopic('Customer-created');
    }

    public function topic()
    {
        return $this->topic;
    }
}
