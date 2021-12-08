<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
// Auth::routes(['verify' => true]);
// ログイン
Route::prefix('login')->name('login.')->group(function () {
  Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
  Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');  
});
# ゲストユーザーログイン
Route::get('guest', 'Auth\LoginController@guestLogin')->name('login.guest');
// アカウント登録
Route::prefix('register')->name('register.')->group(function () {
  Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
  Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

// レシピ一覧
Route::get('/', 'RecipeController@index')->name('recipes.index');

// 検索フォームを表示させるルート
Route::get('/searchresult', 'RecipeController@search')->name('recipes.searchresult');
// 検索
// Route::get('searchResult', 'RecipeController@searchResult')->name('recipes.searchResult');

// indexとshow以外のメソッドルート
Route::resource('/recipes', 'RecipeController')->except(['index','show'])->middleware('auth');
// レシピ詳細のルート
Route::resource('/recipes', 'RecipeController')->only(['show']);
// いいね機能のルート
Route::prefix('recipes')->name('recipes.')->group(function () {
  Route::put('/{recipe}/like', 'RecipeController@like')->name('like')->middleware('auth');
  Route::delete('/{recipe}/like', 'RecipeController@unlike')->name('unlike')->middleware('auth');
});

// コメント
Route::post('/recipe/{comment_id}/comments','CommentController@store');
// Route::delete('/recipe/{comment_id}/comments', 'UserController@delete');
// タグ表示
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

## PW変更
// 通常のアクセス（GET）の場合はshowChangePasswordFormメソッドを実行する
Route::get('/password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.form');
// パスワードの変更処理（POST）の場合はChangePasswordメソッドを実行する
Route::post('/password/change', 'Auth\ChangePasswordController@ChangePassword')->name('password.change');

// メールアドレス変更フォームにアクセス
Route::get('/email_change', 'Auth\ChangeEmailAddressController@emailChangeForm')->name('email_change.form');

// メールアドレス確認メールを送信
Route::post('/email', 'Auth\ChangeEmailAddressController@sendChangeEmailLink')->name('email.change');
// Route::post('/email', 'Auth\ChangeEmailAddressController@emailChange')->name('email.change');

Route::get('/email_update', 'Auth\ChangeEmailAddressController.php@emailUpdate');

// アカウントマイページ関連
Route::prefix('users')->name('users.')->group(function () {
  // Route::get('user/index', 'UserController@index');
  Route::get('/{name}', 'UserController@show')->name('show');
  Route::get('/{name}/edit', 'UserController@edit')->name('edit');
  Route::post('/{name}/update', 'UserController@update')->name('update');
  // いいね一覧
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  // Route::get('/{name}/bookmarks', 'UserController@bookmarks')->name('bookmarks');
  // フォロー一覧
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  // フォロワー一覧
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');
  Route::middleware('auth')->group(function () {
    // フォローをする
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    // フォローを外す
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });

// メールアドレス変更
Route::get('/user/email', 'UserController@userEmailEdit')->name('email.edit');
Route::post('/user/email', 'UserController@userEmailChange')->name('email.change');
Route::get('/user/userEmailUpdate/', 'UserController@userEmailUpdate');

});