<?php

namespace App\Notifications;

use App\Mail\BareMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangeEmailNotification extends Notification
{
    use Queueable;
    public $token;
    public $mail;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $token, BareMail $mail)
    {
      $this->token = $token;
      $this->mail = $mail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
      return $this->mail
      ->from(config('mail.from.address'), config('mail.from.name'))
      ->to($notifiable->email)
      ->subject('[SPOILY]メールアドレス変更URLの送付')
      ->text('emails.change_email')
      ->with([
          'url' => route('email.change', [
              'token' => $this->token,
              'email' => $notifiable->email,
          ]),
          'count' => config(
              'auth.passwords.' .
              config('auth.defaults.passwords') .
              '.expire'
          ),
      ]);
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
}
