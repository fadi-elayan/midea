<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommendsNotification extends Notification
{
    use Queueable;

    public $post_id;
    public $user_id;
    public $command_id;
    public function __construct($data ,$command_id)
    {
        $this->post_id = $data['post_id'];
        $this->user_id = $data['user_id'];
        $this->command_id = $command_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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


    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'command_id'=> $this->command_id
        ];
    }
}
