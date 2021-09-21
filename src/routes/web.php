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
// レシピ一覧
Route::get('/', 'RecipeController@index')->name('recipes.index'); 
Route::resource('/recipes', 'RecipeController')->except(['index','show'])->middleware('auth');
Route::resource('/recipes', 'RecipeController')->only(['show']);
Route::prefix('recipes')->name('recipes.')->group(function () {
  Route::put('/{recipe}/like', 'RecipeController@like')->name('like')->middleware('auth');
  Route::delete('/{recipe}/like', 'RecipeController@unlike')->name('unlike')->middleware('auth');
});
Route::get('/tags/{name}', 'TagController@show')->name('tags.show');
Route::prefix('users')->name('users.')->group(function () {
  Route::get('/{name}', 'UserController@show')->name('show');
  // いいね一覧
  Route::get('/{name}/likes', 'UserController@likes')->name('likes');
  // Route::get('/{name}/bookmarks', 'UserController@bookmarks')->name('bookmarks');
  // フォロー一覧
  Route::get('/{name}/followings', 'UserController@followings')->name('followings');
  // フォロワー一覧
  Route::get('/{name}/followers', 'UserController@followers')->name('followers');
  Route::middleware('auth')->group(function () {
    Route::put('/{name}/follow', 'UserController@follow')->name('follow');
    Route::delete('/{name}/follow', 'UserController@unfollow')->name('unfollow');
  });
});