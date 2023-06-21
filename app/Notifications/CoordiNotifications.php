<?php

namespace App\Notifications;

use App\Models\DeteccionNecesidades;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CoordiNotifications extends Notification
{
    use Queueable;



    /**
     * Create a new notification instance.
     * @param DeteccionNecesidades $necesidades
     * @param User $user
     */
    public function __construct(DeteccionNecesidades $necesidades, User $user)
    {
        $this->necesidades = $necesidades;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'email' => $this->necesidades->jefe_academico->email,
            'id' => $this->necesidades->id,
            'is_clean' => $this->necesidades->isClean(),
            'is_dirty' => $this->necesidades->isDirty(),
            'changed?' => $this->necesidades->wasChanged(),
        ];
    }
}
// Para notificar, es cuando se crea una instancia de deteccion de necesidades, cuando se modifica, esto es para desarrollo
// || ||      cuando existe una observacion

// id de la deteccion, id del usuario, usar metodos isDirty, isClean and wasChanged, para determinar si ha recibido cambios

// id_jefe, id_deteccion, and try with the three methods
