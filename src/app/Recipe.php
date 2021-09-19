<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
  protected $fillable = [
      'recipe_title',
      'content',
      'serving',
      'ingredient',
      'seasoning',
      'step_content',
      'step_content2',
      'step_content3',
      'step_content4',
      'step_content5',
      'step_content6',
      'cooking_point',
    ];

  public function user(): BelongsTo
  {
      return $this->belongsTo('App\User');
  }
}
