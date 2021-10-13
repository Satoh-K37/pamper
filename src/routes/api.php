<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
Route::post('file_upload',function(){

	$file_name = request()->file->getClientOriginalName();

	request()->file->storeAs('public/',$file_name);

	$recipe = App\Recipe::find();

	$recipe->update(['image_path' => '/storage/'.$file_name]);

	return $recipe;
});