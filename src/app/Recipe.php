<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

  // usersテーブルとのリレーション
  public function user(): BelongsTo
  {
      return $this->belongsTo('App\User');
  }
  
  // likesテーブルとのリレーション
  public function likes(): BelongsToMany
  {
      return $this->belongsToMany('App\User', 'likes')->withTimestamps();
  }

  // タグモデルとのリレーション
  public function tags(): BelongsToMany
  {
      return $this->belongsToMany('App\Tag')->withTimestamps();
  }
  
  // カテゴリモデルとのリレーション
  public function categories(): BelongsToMany
  {
    return $this->belongsToMany('App\Category')->withTimestamps();
  }
  
  // コメント機能のためのリレーション  
  public function comments()
  {
    //一つの投稿は複数のコメントを持つことができる
    // コメントAに関して、コメントAに紐づく投稿は一つしかない
    return $this->hasMany('App\Comment');
    
  }

  // あるユーザーがいいね済みかどうかを判定するメソッド
  public function isLikedBy(?User $user): bool
  {
      return $user
          // $userがnullじゃない場合下記の結果をメソッドの呼び出し元に返す
          ? (bool)$this->likes->where('id', $user->id)->count()
          // $userがnullの場合はfalseを返す
          : false;
  }

  //  現在のいいね数を算出するメソッド
  public function getCountLikesAttribute(): int
  {
      return $this->likes->count();
  }
  


}
