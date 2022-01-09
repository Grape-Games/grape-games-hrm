<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeeAccountNotification extends Notification
{
    use Queueable;
    private $details, $db;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details, $db)
    {
        $this->details = $details;
        $this->db = $db;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'mails.mail-with-login-credentials',
            [
                'details' => $this->details,
            ]
        );
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
            'heading' => $this->db['heading'],
            'avatar' => $this->db['avatar'],
            'details' => $this->db['details'],
            'redirect' => $this->db['redirect'],
            'email' => $this->db['email'],
        ];
    }
}
