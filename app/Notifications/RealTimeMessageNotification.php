<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages;
use App\Models\fichier;

class RealTimeMessageNotification extends Notification implements ShouldBroadcast
{
    use Queueable;
    public $fichier;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(fichier $fichier)
    {
        $this->fichier = $fichier;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    public function toArray($notifiable)
{
    return [

          'File Name'=>$this->fichier->name,
          'Created at'=>$this->fichier->date,
    ];
} 

//     public function toBroadcast($notifiable)
//     {
//         return new BroadcastMessage ([
//             'message' => "$this->message (User $notifiable->name)"
//         ]);
//     }
}
