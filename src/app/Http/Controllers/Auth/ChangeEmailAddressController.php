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
use Carbon\Carbon;

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
      $change_email->save();
      
      // $url = url(config('app.url'));
      // メール送付
      if(app()->isLocal() || app()->runningUnitTests()){
      // 開発環境
        Mail::send([ 'text' => 'emails/change_email'], 
        ['emailchange_url' => "http://localhost/email/update/?token={$update_token}"],
        function ($message) use ($change_email) {
          $message->to($change_email->new_email)->subject('[重要]メールアドレス変更URLの送付');
        });
      }else{
        // 本番環境でのメールアドレス変更
        Mail::send([ 'text' => 'emails/change_email'], 
        ['emailchange_url' => "https://spoily.link/email/update/?token={$update_token}"],
        function ($message) use ($change_email) {
          $message->to($change_email->new_email)->subject('[重要]メールアドレス変更URLの送付');
        });
      }
      // マイページ遷移
      session()->flash('flash_message', 'メールアドレス変更の確認メールを送信しました。');
      return view('users.show', [
        'user' => $user,
        'recipes' => $recipes,
      ]);

  }

  public function emailUpdate(Request $request)
  {

    $token = $request->input('token');
    // トークン照合
    $email_change = DB::table('change_email')
    ->where('update_token', '=', $token)->first();

    // トークンが存在しているかつトークンの有効期限が切れていない場合は入る
    if ($email_change && !$this->tokenExpired($email_change->created_at)) {
    // トークン受け取り

    // 照合一致で一時保存DBのメールアドレスをDBメールアドレスに上書
    $user = User::find($email_change->user_id);
    $user->email = $email_change->new_email;
    $user->save();
    // 一時保存DBレコード削除
    DB::table('change_email')
    ->where('update_token', '=', $token)->delete();

    // マイページに遷移する際に必要になる
    $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
    // マイページ遷移
    session()->flash('flash_message', 'メールアドレスの変更が完了しました。');
    return view('users.show', [
      'user' => $user,
      'recipes' => $recipes,
    ]);
    // return redirect()->route('recipes.index')->with('flash_message', 'メールアドレスの変更が完了しました。');

    }else{
      // レコードが存在していた場合は対象レコードを削除
      if ($email_change){
        // 一時保存DBレコード削除
        DB::table('change_email')
        ->where('update_token', '=', $token)->delete();
      }
      return redirect()->route('email_change.form')->with('flash_message', 'URLの有効期限がきれています。再度メールアドレスの変更を行ってください');
    }


  }


  // トークンが有効期限切れかをチェック
  protected function tokenExpired($createdAt)
  {
      // トークンの有効期限は60分に設定
      $expires =  60 * 120;
      return Carbon::parse($createdAt)->addSeconds($expires)->isPast();
  }




}
