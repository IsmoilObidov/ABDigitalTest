<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class TwoFactorCode extends Notification
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Ваш двухфакторый код: ' . $notifiable->two_factor_code)
            ->action('Проверить', route('verify.index'))
            ->line('Срок действия кода — 10 минут')
            ->line('Если вы не пытались войти на сайт, то проигнорируйте это сообщение.');
    }

    // Add the via method to specify the notification channel(s)
    public function via($notifiable)
    {
        return ['mail']; // You can add more channels if needed (e.g., 'sms')
    }
}
