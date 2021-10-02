<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
  protected $fillable = [
    'id',
    'recipe_id',
    'name',
  ];

  public function recipes(): BelongsToMany
  {
      return $this->belongsToMany('App\Recipe', 'category_recipe', 'recipe_id', 'category_id')->withTimestamps();
  }

  // カテゴリーの一覧を取得するメソッド
  public function getCategories()
  {
      $categories = Category::orderBy('id','asc')->pluck('name', 'id');
      // $categories = Category::orderBy('id', 'asc')->get('name', 'id');
      return $categories;
  }
}
