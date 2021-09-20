<?php


namespace App\Http\Controllers;

use App\Recipe;
use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
  public function __construct()
  {
      $this->authorizeResource(Recipe::class, 'recipe');
  }

  public function index()
  {
      $recipes = Recipe::all()->sortByDesc('created_at');
      return view('recipes.index', ['recipes' => $recipes]);
  }

  public function create()
  {
      return view('recipes.create');    
  }

  public function store(RecipeRequest $request, Recipe $recipe)
  {
      $recipe->fill($request->all());
      $recipe->user_id = $request->user()->id;
      $recipe->save();
      return redirect()->route('recipes.index');
  }

  public function edit(Recipe $recipe)
  {
      return view('recipes.edit', ['recipe' => $recipe]);    
  }

  public function update(RecipeRequest $request, Recipe $recipe)
  {
      $recipe->fill($request->all())->save();
      return redirect()->route('recipes.index');
  }

  public function destroy(Recipe $recipe)
  {
      $recipe->delete();
      return redirect()->route('recipes.index');
  }

  public function show(Recipe $recipe)
  {
      return view('recipes.show', ['recipe' => $recipe]);
  }

  public function like(Request $request, Recipe $recipe)
  {
      // レシピモデルと、リクエストを送信したユーザーのユーザーモデルの両者を紐づけるlikesテーブルのレコードが削除される
      // 先にdetachする理由は重複していいねをしてしまうことを回避するために先に削除してから新規登録を行います。
      $recipe->likes()->detach($request->user()->id);
      // レシピモデルと、リクエストを送信したユーザーのユーザーモデルの両者を紐づけるlikesテーブルのレコードが新規登録される
      $recipe->likes()->attach($request->user()->id);

      return [
          'id' => $recipe->id,
          'countLikes' => $recipe->count_likes,
      ];
  }

  public function unlike(Request $request, Recipe $recipe)
  {
      $recipe->likes()->detach($request->user()->id);

      return [
          'id' => $recipe->id,
          'countLikes' => $recipe->count_likes,
      ];
  }

}
