<?php


namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use App\Category;

use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
      $allTagNames = Tag::all()->map(function ($tag) {
          return ['text' => $tag->name];
      });
      
      // $allCategoryNames = Category::all()->map(function ($category) {
      //   return ['text' => $category->name];
      // });

      // $allCategoryNames = Category::pluck('name', 'id');
      $allCategoryNames = Category::all();
      $category = new Category;
      $categories = $category->getCategories()->prepend('選択してください', '');

      
      $servings = config('serving');
      $cooking_times = config('cookingtime');


      return view('recipes.create', [
          'allTagNames' => $allTagNames,
          'allCategoryNames' => $allCategoryNames,
          'categories' => $categories,
          'servings' => $servings,
          'cooking_times'=> $cooking_times
      ]);

  }

  public function store(RecipeRequest $request, Recipe $recipe)
  {
      // dd($request);
      $recipe->fill($request->all());
      $recipe->user_id = $request->user()->id;
      $recipe->save();

      // カテゴリーを追加
      $recipe->categories()->attach($request->category_id);
      // $recipe->save();
      // dd($recipe);

      // もし画像のアップロードがあった場合
      if($request->image_path){
        // Storage::delete('public/image_path', $recipe->image_path);
        // gifまたはjpegまたはjpgまたはpngの場合は投稿IDをファイル名にして保存。それ以外の場合はスルーする。
        if( $request->image_path->extension() == 'gif' 
        || $request->image_path->extension() == 'jpeg' 
        || $request->image_path->extension() == 'jpg' 
        || $request->image_path->extension() == 'png'){
        $request->file('image_path')->storeAs('public/image_path', $recipe->id.'.'.$request->image_path->extension());
        }
      };

      $request->tags->each(function ($tagName) use ($recipe) {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $recipe->tags()->attach($tag);
      });

      // $request->categories->each(function ($categoryName) use ($recipe) {
      //   $category = Category::firstOrCreate(['name' => $categoryName]);
      //   $recipe->categories()->attach($category);
      // });

      // dd($recipe);
      return redirect()->route('recipes.index');
  }

  public function edit(Recipe $recipe)
  {
      $tagNames = $recipe->tags->map(function ($tag) {
          return ['text' => $tag->name];
      });

      $allTagNames = Tag::all()->map(function ($tag) {
        return ['text' => $tag->name];
      });

      $allCategoryNames = Category::all();
      
      $category = new Category;
      $categories = $category->getCategories();
      // category_idを取得する
      $old_category_id = Recipe::find($recipe->id)->categories()->where('recipe_id', '=', $recipe->id)->first();

      $servings = config('serving');
      $cooking_times = config('cookingtime');
      // print_r($old_serving);
      // dd($old_category_id->id);
      // $recipe_file = Recipe::findOrFail($request->id);


      return view('recipes.edit', [
        'recipe' => $recipe,
        'tagNames' => $tagNames,
        'allTagNames' => $allTagNames,
        'allCategoryNames' => $allCategoryNames,
        // 'inputCategory' => $inputCategory,
        'categories' => $categories,
        'old_category_id' => $old_category_id,
        'servings' => $servings,
        'cooking_times' => $cooking_times,
        // 'recipe_file' => $recipe_file
      ]);
  }

  public function update(RecipeRequest $request, Recipe $recipe)
  {
  
      $recipe->fill($request->all())->save();
      //更新フォームから送られてきたリクエストパラメーターにFileデータが存在しているかを確認する
      // Fileデータが存在していない場合はそのまま登録を行う。存在している場合はifの中の処理を行う
      // src/storage/app/public/image_pathディレクトリに更新をかけるレシピのIDの画像データがないかを確認する
      // 画像データがなかった場合はそのままデータを登録し、あった場合はレシピIDに一致する画像を削除する。

            // もし画像のアップロードがあった場合
      if($request->image_path){
        // Storage::delete('public/image_path', $recipe->image_path);
        // gifまたはjpegまたはjpgまたはpngの場合は投稿IDをファイル名にして保存。それ以外の場合はスルーする。
        // if( $request->image_path->extension() == 'gif' 
        // || $request->image_path->extension() == 'jpeg' 
        // || $request->image_path->extension() == 'jpg' 
        // || $request->image_path->extension() == 'png'){
        $extension = $request->file('image_path')->getClientOriginalExtension();
        dd($extension);
        // $request->file('image_path')->storeAs('public/image_path', $recipe->id.'.'.$request->image_path->extension());
        // }
      };
      $extension = $request->file('image_path')->getClientOriginalExtension();

      // dd($recipe); 
      $recipe->categories()->sync($request->category_id);

      // 既存のタグを全て削除
      $recipe->tags()->detach();
      $request->tags->each(function ($tagName) use ($recipe) {
          $tag = Tag::firstOrCreate(['name' => $tagName]);
          $recipe->tags()->attach($tag);
      });


      // $request->tags->each(function ($tagName) use ($recipe) {
      //   $tag = Tag::firstOrCreate(['name' => $tagName]);
      //   $recipe->tags()->attach($tag);
      // });
      
      // dd($recipe);
      return redirect()->route('recipes.index');
  }

  public function destroy(Recipe $recipe)
  {
      $recipe->delete();
      return redirect()->route('recipes.index');
  }

  public function show(Recipe $recipe)
  {
      // $recipe=Recipe::find($recipe.id)
      
      return view('recipes.show', ['recipe' => $recipe]);
  }

  public function like(Request $request, Recipe $recipe)
  {
      // レシピモデルと、リクエストを送信したユーザーのユーザーモデルの両者を紐づけるlikesテーブルのレコードが削除される
      // 先にdetachする理由は重複していいねをしてしまうことを回避するために先に削除してから新規登録を行う。
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


