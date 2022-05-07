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
      // $request->session()->regenerateToken();
      // Commentモデル作成
      $comment = new Comment;
      $comment->comment = $request->comment;
      $comment->recipe_id = $request->recipe_id;
      $comment->user_id = Auth::user()->id;
      $comment->save();

      // 二重送信対策
      $request->session()->regenerateToken();
      // 直前にリダイレクト
      return redirect()->back()->with('comment_flash_message', 'コメントを投稿しました');
  }  

  public function destroy(Comment $comment)
  // public function destroy(Request $request)
  {
    if(Auth::id() == $comment->user_id) {
      $comment = Comment::find($comment->id);
      // dd($comment);
      $comment->delete();

      // return redirect()->route('comment', $user->id);
      return redirect()->back()->with('comment_flash_message', 'コメントの削除が完了しました');
    }
      // return view('recipes.show', ['recipe' => $recipe]);
      // if(Auth::id() == $comment->user_id || Auth::id() == $item->user_id) {
      //   $comment->delete();
      //   // return redirect()->route('comment', $user->id);
      //   return redirect()->back()->with('comment_flash_message', 'コメントの削除が完了しました');
  
      //   // return view('recipes.show', ['recipe' => $recipe]);
      // }
  }

}

