<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Storage as Storage;
use App\User;





class UserController extends Controller
{
  public function __construct(User $user)
  {
      $this->user = $user;
  }

  public function edit(String $name)
  {
    // ログインしているユーザーの情報を取得
    // $auth = Auth::user();
    $user = User::where('name', $name)->first();
    // dd($user);    // $user = $this->user->selectUserFindById($id);
    // return view('users.edit', compact('user'));

    return view('users.edit',[ 'user' => $user ]);
  }

  public function update(Request $request, String $name)
  {
    $user = User::where('name', $name)->first();
    $user_form = $request->all();
    //不要な「_token」の削除
    unset($user_form['_token']);
    // リクエストにprofile_imageが送られてきているかを確認。送られてきている場合はifの中の処理を実行
    if(isset($user_form['profile_image'])){
      
      $file = $request->profile_image;
      // アップロードされた画像の拡張子の取得。
      // $ext = $request->file('profile_image')->getClientOriginalExtension();
      $extension = $file->extension();
      // ファイル名をランダムで作成
      $file_name = uniqid(rand(). '_');
      // ファイル名と取得した拡張子を合体
      $icon_file_name = $file_name.".".$extension;

      if(app()->isLocal() || app()->runningUnitTests()){
        // 削除する画像名を取得 
        $delete_icon = $user->profile_image;
        // 削除する画像が存在しているディレクトリのパスを取得
        $delete_path = storage_path().'/app/public/icons/'. $delete_icon;
        // $delete_pathに入っている画像パスと一致する画像データを削除
        \File::delete($delete_path);
        // $formのimage_pathにファイル名と取得した拡張子を合体した物を代入する。
        $user_form['profile_image'] = $icon_file_name;
        // storeAsでオリジナルの画像名をつけて、指定のディレクトリに画像を保存
        $request->profile_image->storeAs('public/icons/',$icon_file_name);
        
      }else{
        // 削除する画像名を取得 
        $delete_icon = $user->profile_image;
        // 取得した画像ファイル名と一致する画像ファイルをS3から削除する
        Storage::disk('s3')->delete($delete_icon);
        // S3に保存
        $path = Storage::disk('s3')->putFile('public/icons', $file);
        // usersテーブルのprofile_imageに$pathに格納されたパスを保存
        $user_form['profile_image'] = Storage::disk('s3')->url($path);
      }
    }
    
    $user->fill($user_form)->save();
    $user->password = bcrypt($request->get('password'));
    
    $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
    session()->flash('flash_message', 'プロフィールの編集が完了しました');
    return view('users.show', [
      // 'auth' => $auth,
      'user' => $user,
      'recipes' => $recipes,
  ]);
  }

  public function show(string $name)
  {
      // $auth = Auth::user();
      $user = User::where('name', $name)->first();
      $recipes = $user->recipes->sortByDesc('created_at')->paginate(10);
      // ->paginate();

      return view('users.show', [
          // 'auth' => $auth,
          'user' => $user,
          'recipes' => $recipes,
      ]);
  }

  // いいねしたレシピ一覧を表示するメソッド
  public function likes(string $name)
  {
      $user = User::where('name', $name)->first();

      $recipes = $user->likes->sortByDesc('created_at')->paginate(10);
      // ->paginate();
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
      $recipes = $user->likes->sortByDesc('created_at')->paginate(10);

      return view('users.followings', [
          'user' => $user,
          'followings' => $followings,
          'recipes' => $recipes,
      ]);
  }
  
  // フォロワー一覧を表示
  public function followers(string $name)
  {
      $user = User::where('name', $name)->first();

      $followers = $user->followers->sortByDesc('created_at');
      $recipes = $user->likes->sortByDesc('created_at')->paginate(10);

      return view('users.followers', [
          'user' => $user,
          'followers' => $followers,
          'recipes' => $recipes,
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
