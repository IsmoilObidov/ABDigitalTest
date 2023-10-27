<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class ResetVerification extends Notification
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
            ->line('Нажмите на эту ссылку чтобы обновить пароль')
            ->action('Сброс пароля ', route('reset.view-reset-password', ['id' => $notifiable->id]))
            ->line('Срок действия ссылки — 10 минут')
            ->line('Если вы не пытались сбросить свой пароль, то проигнорируйте это сообщение.');
    }

    // Add the via method to specify the notification channel(s)
    public function via($notifiable)
    {
        return ['mail']; // You can add more channels if needed (e.g., 'sms')
    }
}
