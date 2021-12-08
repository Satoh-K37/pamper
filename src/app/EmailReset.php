<?php

namespace App;

use App\Notifications\ChangeEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class EmailReset extends Model
{
  use Notifiable;

  protected $fillable = [
    'user_id',
    'new_email',
    'update_token',
  ];
    /**
     * メールアドレス確定メールを送信
     *
     * @param [type] $update_token
     * 
     */
    public function sendEmailResetNotification($update_token)
    {
        $this->notify(new ChangeEmail($update_token));
    }

    /**
     * 新しいメールアドレスあてにメールを送信する
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->new_email;
    }
}
