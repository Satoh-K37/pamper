<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChangeEmailAddressController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function emailChangeform()
  {
    return view('auth.email_change');
  }

  public function emailChange(Request $request)
  {
    // ログインしてるユーザーのレコードを取得
    $auth = Auth::user();
    // リクエストデータを受け取る
    $new_email = $request->input('email');
    // メール照合用トークンの生成
    $update_token = hash_hmac(
      'sha256',
      str_random(40).$new_email,
      env('APP_KEY')  
    );

  // 変更データ一時保存DBへレコード保存
  $change_email = new ChangeEmail;
  $change_email->user_id = $auth->id;

  $change_email->new_email = $new_email;

  $change_email->update_token = $update_token;

  $change_email->save();



    Mail::send('index', ['user' => $user], function ($m) use ($user) {
      $m->from('no-reply@example.com', '【SPOILY運営】メールアドレス変更についてのお知らせ');
      $m->to($user->email, $user->name)->subject('Your Reminder!');
    });

    $form = $request->input('email');
    return [$auth, $form];

  }

  public function userEmailUpdate(Request $request)
  {
  }
}
