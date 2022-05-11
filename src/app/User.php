<?php

namespace App;

use App\Mail\BareMail;
use App\Notifications\PasswordResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'self_introduction',
        'profile_image',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token, new BareMail()));
    }

    public function recipes(): HasMany
    {
        return $this->hasMany('App\Recipe');
        // return $this->hasMany(Recipe::class);
    }

    // usersテーブルとfollowsテーブルのリレーション
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')->withTimestamps();
    }

    // フォローするユーザー、フォロー中のユーザーのモデルにアクセス可能にするためのリレーションメソッド
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')->withTimestamps();
    }

    // ユーザーがいいねしたレシピモデルにアクセスするためのリレーション
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\Recipe', 'likes')->withTimestamps();
    }

    // コメント機能のリレーション
    // ユーザーは複数のコメントをするコトができるが、コメントAをしたユーザーは一人しかいないので１対多の関係になる
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    // あるユーザーをフォロー中かどうか判定するメソッド
    public function isFollowedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->followers->where('id', $user->id)->count()
            : false;
    }

    // フォロー中のユーザーの数を算出するアクセサ
    public function getCountFollowersAttribute(): int
    {
        return $this->followers->count();
    }

    // フォロワーの数を算出するアクセサ
    public function getCountFollowingsAttribute(): int
    {
        return $this->followings->count();
    }

}
