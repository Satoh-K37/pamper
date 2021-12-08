<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class ChangeEmailAddressController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    // $this->middleware('verified')->except(['emailChangeform', 'changeEmail']);
  }

  public function emailChangeform()
  {
    return view('auth.email_change');
  }

  public function sendChangeEmailLink(Request $request){
    $user = Auth::user();
    // ユーザーの投稿を取得するための変数
    $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
    $new_email = $request->new_email;
        // トークン生成
    $token = hash_hmac(
      'sha256',
      Str::random(40) . $new_email,
      config('app.key')
    );

      // トークンをDBに保存
    DB::beginTransaction();
    try {
        $param = [];
        $param['user_id'] = Auth::id();
        $param['new_email'] = $new_email;
        $param['update_token'] = $update_token;
        $email_reset = EmailReset::create($param);

        DB::commit();

        $email_reset->sendEmailResetNotification($update_token);

        
      return view('users.show', [
        'user' => $user,
        'recipes' => $recipes,
      ])->with('flash_message', '確認メールを送信しました。');
    } catch (\Exception $e) {
        DB::rollback();
        return view('users.show', [
          'user' => $user,
          'recipes' => $recipes,
        ])->with('flash_message', 'メール更新に失敗しました。');
    }
  }
  // public function changeEmail(Request $request)
  // {
  //   // ログインしてるユーザーのレコードを取得
  //   $user = Auth::user();
  //   // メールアドレスの変更がない場合は、何も処理せす完了する。エラー表示の方がいいかな？
  //   if ($user->email == $request->get('email')){
  //     return redirect()->route('setting')->with('status', __('"メールアドレス変更の確認メールを送信しました。'));
  //   }
  //   // フォームに入力されたメールアドレスを取得する
  //   $user->email = $request->get('email');
  //   // メール認証をリセットする
  //   $user->email_verified_at = null;
  //   $user->save();
  //   // 認証メールを送信する
  //   $user->sendEmailVerificationNotification();
  //   // マイページに遷移させるので自身が投稿したレシピなどを取得する
  //   $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
  //   // マイページ遷移
  //   return view('users.show', [
  //     // 'auth' => $auth,
  //     'user' => $user,
  //     'recipes' => $recipes,
  //   ])->with('status', __('メールアドレス変更の確認メールを送信しました。'));

  // }

  public function userEmailUpdate(Request $request)
  {
  }
}
