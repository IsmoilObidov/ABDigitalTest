<?php

namespace App\Exceptions;

use Throwable;
use App\Exceptions\Handler;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramExceptionHandler extends Handler
{
    public function report(Throwable $exception)
    {
        if ($this->isCriticalError($exception)) {
            $this->sendTelegramNotification($exception);
        }

        parent::report($exception);
    }

    private function isCriticalError(Throwable $exception)
    {
        // You can define your criteria for identifying critical errors here
        // For example, check the type of exception, HTTP status codes, etc.
        return true; // Modify this as needed
    }

    private function sendTelegramNotification(Throwable $exception)
    {
        // Send a Telegram message for critical errors
        $telegram = new Api(config('telegram.bot_token'));
        $telegram->sendMessage([
            'chat_id' => config('telegram.chat_id'),
            'text' => 'Critical Error: ' . $exception->getMessage(),
        ]);
        Log::info('Telegram message sent for critical error: ' . $exception->getMessage());
    }
}
