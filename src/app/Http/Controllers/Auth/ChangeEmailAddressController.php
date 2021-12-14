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

  // public function sendChangeEmailLink(Request $request){
  //   $user = Auth::user();
  //   // ユーザーの投稿を取得するための変数
  //   $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
  //   $new_email = $request->new_email;
  //       // トークン生成
  //   $token = hash_hmac(
  //     'sha256',
  //     Str::random(40) . $new_email,
  //     config('app.key')
  //   );

  //     // トークンをDBに保存
  //   DB::beginTransaction();
  //   try {
  //       $param = [];
  //       $param['user_id'] = Auth::id();
  //       $param['new_email'] = $new_email;
  //       $param['update_token'] = $update_token;
  //       $email_reset = EmailReset::create($param);

  //       DB::commit();

  //       $email_reset->sendEmailResetNotification($update_token);

        
  //     return view('users.show', [
  //       'user' => $user,
  //       'recipes' => $recipes,
  //     ])->with('flash_message', '確認メールを送信しました。');
  //   } catch (\Exception $e) {
  //       DB::rollback();
  //       return view('users.show', [
  //         'user' => $user,
  //         'recipes' => $recipes,
  //       ])->with('flash_message', 'メール更新に失敗しました。');
  //   }
  // }

  // public function changeEmail(Request $request){
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

  public function emailChange(Request $request)
  {
    // 対象レコード取得
    $user = Auth::user();

    // ユーザーのメールアドレスと一致した場合は変更がないと表示させる
    if ($user->email == $request->get('new_email')){
      return redirect()->route('email_change.form')->with('flash_message', 'メールアドレスの変更はありません。');
    }

    $old_email = $request->get('new_email');
    // これでUserテーブルにnew_emailの値で検索かけて存在していた場合は、ifに入る
    $exist_email = User::where($old_email);
    if (isset($exist_email)){
      return redirect()->route('email_change.form')->with('flash_message', 'メールアドレスはすでに使われています。');
    }
    // $form = $request->all();
    // dd($form);
    $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
    // リクエストデータ受取
    $new_email = $request->input('new_email');
    // dd($new_email);
    // メール照合用トークン生成
    $update_token = hash_hmac(
      'sha256',
      Str::random(40).$new_email,
      env('APP_KEY')
    );
      
      // 変更データ一時保存DBへレコード保存
      // DB::table('change_email')->insert([
      //   [
      //       'user_id' => $user->id,
      //       'new_email' => $new_email,
      //       'update_token' => $update_token
      //   ]
      // ]);
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
