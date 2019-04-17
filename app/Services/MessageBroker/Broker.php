<?php

namespace App\Services\MessageBroker;

use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPConnection;

class Broker
{

    private $connection;
    private $channel;
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->build();
    }

    /**
     * Setup message broker
     * @return Broker
     */
    public function build()
    {
        return $this->makeConnection()
            ->declareQueue()
            ->exchangeDeclare()
            ->bindQueue();
    }

    /**
     * Make connection
     * @return $this
     */
    public function makeConnection()
    {
        // Make connection
        $this->connection = new AMQPConnection(
            $this->config['host'],
            $this->config['port'],
            $this->config['username'],
            $this->config['password'],
            '/'
        );
        // Get channel instance
        $this->channel = $this->connection->channel();
        return $this;
    }

    /**
     * Declate queue
     * @return $this
     */
    public function declareQueue()
    {
        $this->channel->queue_declare($this->config['queue'], false, true, false, false);
        return $this;
    }

    /**
     * Exchange declare
     * @return $this
     */
    public function exchangeDeclare()
    {
        $this->channel->exchange_declare($this->config['exchange'], 'direct', false, true, false);
        return $this;
    }

    public function bindQueue()
    {
        $this->channel->queue_bind($this->config['queue'], $this->config['exchange']);
        return $this;
    }

    /**
     * Build AMQPMessage
     * @param array $payload
     * @return AMQPMessage
     */
    public function buildPayload(array $payload)
    {
        return new \PhpAmqpLib\Message\AMQPMessage(json_encode($payload), [
            'content_type' => 'text/plain',
            'delivery_mode' => 2
        ]);
    }

    /**
     * Send message
     * @param array $payload
     * @return bool
     */
    public function send(array $payload)
    {
        try{
            $this->channel->basic_publish($this->buildPayload($payload), $this->config['exchange']);
            return true;
        }catch (\PhpAmqpLib\Exception\AMQPConnectionClosedException $exception){
            \Illuminate\Support\Facades\Log::critical('[Broker] Message send failed',$exception);
            return false;
        }
    }
}
