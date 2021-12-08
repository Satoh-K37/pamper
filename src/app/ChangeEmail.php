<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeEmail extends Model
{
  protected $table = 'change_email';

  protected $fillable = [
    'user_id',
    'new_email',
    'update_token',
  ];
}
