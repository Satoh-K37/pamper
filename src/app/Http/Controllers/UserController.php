<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

  public function edit()
  {
    // ログインしているユーザーの情報を取得
    return view('users.edit', ['user' => Auth::user() ]);

  }

  public function update(Request $request , String $name)
  {

  }

  public function show(string $name)
  {
      $user = User::where('name', $name)->first();
      $recipes = $user->recipes->sortByDesc('created_at');

      return view('users.show', [
          'user' => $user,
          'recipes' => $recipes,
      ]);
  }

  // いいねしたレシピ一覧を表示するメソッド
  public function likes(string $name)
  {
      $user = User::where('name', $name)->first();

      $recipes = $user->likes->sortByDesc('created_at');

      return view('users.likes', [
          'user' => $user,
          'recipes' => $recipes,
      ]);
  }

  // フォロー一覧を表示
  public function followings(string $name)
  {
      $user = User::where('name', $name)->first();

      $followings = $user->followings->sortByDesc('created_at');

      return view('users.followings', [
          'user' => $user,
          'followings' => $followings,
      ]);
  }
  
  // フォロワー一覧を表示
  public function followers(string $name)
  {
      $user = User::where('name', $name)->first();

      $followers = $user->followers->sortByDesc('created_at');

      return view('users.followers', [
          'user' => $user,
          'followers' => $followers,
      ]);
  }


  // フォローするメソッド
  public function follow(Request $request, string $name)
  {
      $user = User::where('name', $name)->first();

      if ($user->id === $request->user()->id)
      {
          return abort('404', '自分自身をフォローすることはできません。');
      }

      $request->user()->followings()->detach($user);
      $request->user()->followings()->attach($user);

      return ['name' => $name];
  }
  
  // フォローを解除するメソッド
  public function unfollow(Request $request, string $name)
  {
      $user = User::where('name', $name)->first();

      if ($user->id === $request->user()->id)
      {
          return abort('404', '自分自身をフォローすることはできません。');
      }

      $request->user()->followings()->detach($user);

      return ['name' => $name];
  }


}
