<?php

namespace Test\Infrastructure;

use App\Infrastructure\Frameworks\MessageBrokers\ConfigKafkaMessageBroker;
use RdKafka;
use PHPUnit\Framework\TestCase;

class ConfigKafkaMessageTest extends TestCase
{
    private string $key  = 'metadata.broker.list';
    private string $host = '192.168.100.3:9092';
    
    public function testConnectionKafkaReturnTrue()
    {
        $kafkaConnect = new ConfigKafkaMessageBroker($this->key, $this->host);

        $this->assertInstanceOf(ConfigKafkaMessageBroker::class, $kafkaConnect); 
    }

    public function testReturnTopicIsTrue()
    {
        $kafkaConnect = new ConfigKafkaMessageBroker($this->key, $this->host);

        $topic = $kafkaConnect->getTopic();

        $this->assertInstanceOf(RdKafka\Topic::class, $topic); 
    }
}
