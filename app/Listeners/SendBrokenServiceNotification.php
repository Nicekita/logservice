<?php

namespace App\Listeners;

use App\Enums\Frequency;
use App\Events\ServiceBroken;
use App\Repository\TelegramRepository;
use Illuminate\Support\Facades\Log;
use TelegramBot\Request;
use TelegramBot\Telegram;

class SendBrokenServiceNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ServiceBroken $event): void
    {
        // Send notification to the service owner
        $data = $event->data;
        $service = $event->service;

        $logsCount = $data['logs_count'] ?? 0;
        Telegram::setToken(config('app.telegram'));
        $frequency = Frequency::translate($service->freq);
        $message = "Сервис $service->key за последние $service->interval $frequency отправил всего $logsCount логов";
        $result = Request::sendMessage([
            'chat_id' => TelegramRepository::getUserId(),
            'text' => $message,
        ]);

        if (!$result->getOk()) {
            Log::error('Бот недоступен или введенны неверные данные конфигурации');
        }
    }
}
