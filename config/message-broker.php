<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Default
     |--------------------------------------------------------------------------
     |
     | This value is the name of your message broker.
     |
     */
    'default' => 'RabbitMQ',
    /*
     |--------------------------------------------------------------------------
     | Host
     |--------------------------------------------------------------------------
     |
     | This value is the name of your host.
     |
     */
    'host' => env('RABBITMQ_HOST', '127.0.0.1'),
    /*
     |--------------------------------------------------------------------------
     | Port
     |--------------------------------------------------------------------------
     |
     | This value is the name of your message broker running on port.
     |
     */
    'port' => env('RABBITMQ_PORT', 5672),
    /*
     * Username
     */
    'username' => env('RABBITMQ_USERNAME', 'admin'),
    /*
     * Password
     */
    'password' => env('RABBITMQ_PASSWORD', 'admin'),
    /*
     * Exchange
     */
    'exchange' => 'router',
    /*
     * Queue name
     */
    'queue' => 'possbill-test'
];
