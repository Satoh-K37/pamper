<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Recipe;
use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Http\Requests\CommentRequest;



class CommentController extends Controller
{
  public function __construct()
  {
      // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
      $this->middleware('auth');
  }
  public function store(Request $request)
  {
      // Commentモデル作成
      $comment = new Comment;
      $comment->comment = $request->comment;
      $comment->recipe_id = $request->recipe_id;
      $comment->user_id = Auth::user()->id;
      $comment->save();

      // 直前にリダイレクト
      return redirect()->back();
  }  

  public function destroy(Request $request)
  {
      $comment = Comment::find($request->comment_id);
      $comment->delete();

      return redirect()->back();
  }

}

