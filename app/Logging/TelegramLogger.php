<?php

namespace App\Logging;

use Psr\Log\LoggerInterface;
use Telegram\Bot\Api;

class TelegramLogger implements LoggerInterface
{
    protected $api;

    public function __construct(Api $api)
    {
        $this->api = $api;
    }

    public function emergency($message, array $context = [])
    {
        $this->log('emergency', $message);
    }

    public function alert($message, array $context = [])
    {
        $this->log('alert', $message);
    }

    public function critical($message, array $context = [])
    {
        $this->log('critical', $message);
    }

    public function error($message, array $context = [])
    {
        $this->log('error', $message);
    }

    public function warning($message, array $context = [])
    {
        $this->log('warning', $message);
    }

    public function notice($message, array $context = [])
    {
        $this->log('notice', $message);
    }

    public function info($message, array $context = [])
    {
        $this->log('info', $message);
    }

    public function debug($message, array $context = [])
    {
        $this->log('debug', $message);
    }

    protected function log($level, $message)
    {
        $this->api->sendMessage([
            'chat_id' => config('telegram.chat_id'),
            'text' => "[$level] $message",
        ]);
    }
}
