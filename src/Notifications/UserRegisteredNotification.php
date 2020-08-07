<?php

namespace ConfrariaWeb\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return isset($notifiable->email)? ['database', 'mail'] : ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('Seja bem vindo ao ' . config('app.name')))
            ->greeting('Olá ' . $notifiable->name . '!')
            ->line('Seu cadastro foi criado com sucesso!')
            ->action('Acessar o sistema', config('app.url'))
            ->line('Ficamos a disposição para qualquer duvida.')
            ->salutation('Saudações, ' . config('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => __('Usuário criado com sucesso'),
            'notifiable' => $notifiable
        ];
    }
}
