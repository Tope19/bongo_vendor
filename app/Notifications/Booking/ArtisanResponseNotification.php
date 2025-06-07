<?php

namespace App\Notifications\Booking;

use App\Mail\AppMailer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ArtisanResponseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'database' ,'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new AppMailer([
            "data" => $this->data,
            "template" => "emails.booking.artisan_response",
            "subject" => $this->data["title"],
        ]))->to($notifiable->email);
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
            //
        ];
    }

    public function toDatabase($notifiable)
    {
        return [
            "data" => $this->data["meta"] ?? [],
            "title" => $this->data["title"] ?? null,
            "message" => $this->data["message"] ?? null,
            "link" => $this->data["link"] ?? null
        ];
    }
}
