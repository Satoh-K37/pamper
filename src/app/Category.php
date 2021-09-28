<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
  protected $fillable = [
    'name',
  ];

  public function recipes(): BelongsToMany
  {
      return $this->belongsToMany('App\Recipe');
      
  }
}
