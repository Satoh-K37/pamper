<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
      // 割り当て許可
    // protected $fillable = [
    //     'recipe_id',
    //     'comment', 
    // ];

  Public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function recipe()
  {
    return $this->belongsTo('App\Recipe');
  }

}
