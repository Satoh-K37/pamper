<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

    public function showChangePasswordForm()
    {
      
      return view('auth.passwords.change');
      

      // return view('users.edit',[ 'user' => $user ]);

    }
      
    public function changePassword(ChangePasswordRequest $request)
    {
      // dd($request);
      //ValidationはChangePasswordRequestで処理
      // ログイン中のユーザーを取得
      $user = Auth::user();
      // ユーザーの投稿を取得するための変数
      $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
      // パスワード変更フォームから送られてきたパスワードを元にPWを更新
      $user->password = bcrypt($request->get('password'));
      $user->save();

      return view('users.show', [
          // 'auth' => $auth,
          'user' => $user,
          'recipes' => $recipes,
      ]);

    }
    
}
