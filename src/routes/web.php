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
Route::get('/', 'RecipeController@index')->name('recipes.index'); 
Route::resource('/recipes', 'RecipeController')->except(['index','show'])->middleware('auth');
Route::resource('/recipes', 'RecipeController')->only(['show']);
Route::prefix('recipes')->name('recipes.')->group(function () {
  Route::put('/{recipe}/like', 'RecipeController@like')->name('like')->middleware('auth');
  Route::delete('/{recipe}/like', 'RecipeController@unlike')->name('unlike')->middleware('auth');
});