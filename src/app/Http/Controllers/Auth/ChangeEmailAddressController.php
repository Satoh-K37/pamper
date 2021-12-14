<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ChangeEmailRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\ChangeEmail;
use App\User;

class ChangeEmailAddressController extends Controller
{
  public function __construct()
  {
      // $this->user = $user;
      $this->middleware('auth');
  }

  public function emailChangeform()
  {
    return view('auth.email_change');
  }

  public function emailChange(Request $request)
  {
    // ログインしているユーザーを取得
    $user = Auth::user();
    // マイページに遷移する際に必要になる
    $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
    
    // ユーザーのメールアドレスと一致した場合はマイページに遷移し、変更がないと表示させる
    if ($user->email === $request->get('new_email')){
      session()->flash('flash_message', 'メールアドレスの変更はありません。');
      return view('users.show', [
        'user' => $user,
        'recipes' => $recipes,
      ]);
    }
    // すでにメールアドレスが登録されている場合は確認メールを送信させない
    // DBに検索かけて存在していた場合は、ifに入る
    if (DB::table('users')->where('email', $request->get('new_email'))->exists()){
      // メールアドレス変更入力フォームにリダイレクトし、メッセージを表示させる
      return redirect()->route('email_change.form')->with('flash_message', 'メールアドレスはすでに使われています。');
    }

    // メールアドレスが登録されていなかった場合は通常通りにメールを送信させる。
    // リクエストデータ受取
    $new_email = $request->input('new_email');
    // dd($new_email);
    // メール照合用トークン生成
    $update_token = hash_hmac(
      'sha256',
      Str::random(40).$new_email,
      env('APP_KEY')
    );
      
      $change_email = new ChangeEmail;
      $change_email->user_id = $user->id;
      $change_email->new_email = $new_email;
      $change_email->update_token = $update_token;
      // dd($change_email);
      $change_email->save();
      // dd($change_email);
      // メール送付
      $domain = env('APP_URL');

      // 第一引数でメールテンプレートを指定している。第二引数でリンクURLを生成してる？
      Mail::send([ 'text' => 'emails/change_email'], 
      ['emailchange_url' => "{$domain}/email/update/?token={$update_token}"],
      function ($message) use ($change_email) {
        $message->to($change_email->new_email)->subject('[重要]メールアドレス変更URLの送付');
      });
      // マイページ遷移
      session()->flash('flash_message', 'メールアドレス変更の確認メールを送信しました。');
      return view('users.show', [
        'user' => $user,
        'recipes' => $recipes,
      ]);

  }

  public function emailUpdate(Request $request)
  {
    // トークン受け取り
    $token = $request->input('token');
    // トークン照合
    $email_change = DB::table('change_email')
    ->where('update_token', '=', $token)->first();

    // 照合一致で一時保存DBのメールアドレスをDBメールアドレスに上書
    $user = User::find($email_change->user_id);
    $user->email = $email_change->new_email;
    $user->save();
    // 一時保存DBレコード削除
    DB::table('change_email')
    ->where('update_token', '=', $token)->delete();

    // $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
    // 変更完了通知
    // (----あとで作成----)
    // リダイレクト
    return redirect()->route('recipes.index')->with('flash_message', 'メールアドレスの変更が完了しました。');

  }
}
