<?php


namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use App\Category;

use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 

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
      // dd($request->all());
      // リクエストデータを受け取る
      $form = $request->all();
      // dd($form);
      // フォームトークン削除。おまじない？
      unset($form['_token']);
      // 画像データがあるかを確認
      if(isset($form['image_path'])){
        $file = $request->file('image_path');
        $ext = $file->getClientOriginalExtension();
        $file_token = Str::random(32);
        $imageFile = $file_token.".".$ext;
        $form['image_path'] = $imageFile;
        // dd($request->image_path);
        $request->image_path->storeAs('public/images/',$imageFile);
        // dd($tes);
      }
      // dd($request);
      // $recipe->categories()->sync($request->id);
      $recipe->user_id = $request->user()->id;
      $recipe->fill($form)->save();
      // $recipe->save();
      // カテゴリーを追加
      $recipe->categories()->attach($request->category_id);
      // $recipe->save();
      // dd($recipe);

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
      ]);
  }

  public function update(RecipeRequest $request, Recipe $recipe)
  {
      $recipe_id = $recipe->id;


      // dd($request->image_path);
      // リクエストデータを受け取る
      $form = $request->all();
      // dd($form['image_path']);
      // フォームトークン削除。おまじない？
      unset($form['_token']);
      // 画像データがあるかを確認
      if(isset($form['image_path'])){
          // 削除する画像名を取得
          $delete_image = $recipe->image_path;
          // dd($delete_image);
          // 削除する画像が存在しているディレクトリのパスを取得
          $delete_path = storage_path().'/app/public/images/'.$delete_image;
          // dd($delete_path);
          // $delete_pathに入っている画像パスと一致する画像データを削除
          \File::delete($delete_path);
        // dd($request->image_path);
        // 画像を削除後の処理が思い浮かばん…Nullだった場合だと一番最初に登録してなかった時に…
        // って思ったけど、画像を必須にすればいい話やったな。オススメご飯を共有するサイトで画像ないのはきつすぎやろて！解決

        // リクエストで画像が送られてきているかを確認し、画像が送られてきている場合は新しく画像を登録
        // 画像が送られてこないということはバリデーション的にありえない
        // if(isset($request->image_path)){
          $file = $request->image_path;
          // dd($file);
          // アップロードされた画像の拡張子の取得。getClientOriginalExtension();だとできなかった…なぜ？
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          // $ext = $request->file('image_path')->getClientOriginalExtension();
          // dd($ext);
          // ファイル名をランダムで作成
          $file_token = Str::random(32);
          // ファイル名と取得した拡張子を合体
          $imageFile = $file_token.".".$ext;
          
          // dd($imageFile);
          $form['image_path'] = $imageFile;
          // $path = $request->file('image')->store('public/image');
          // dd($form['image_path']);
          // ここでエラーがでる。
          // 
          // dd($request->file('update_image_path'));
          $recipe->image_path->storeAs('public/images/', $imageFile);
          // $form['image_path'] = basename($path);
          // $form->image_path = basename($path);
          // dd($form['image_path']);
        // }
    }


        $recipe->user_id = $request->user()->id;
        $recipe->fill($form)->save();

      // $recipe->fill($request->all())->save();
      // dd($recipe); 
      $recipe->categories()->sync($request->category_id);

      $recipe->tags()->detach();
      $request->tags->each(function ($tagName) use ($recipe) {
          $tag = Tag::firstOrCreate(['name' => $tagName]);
          $recipe->tags()->attach($tag);
      });
      
      // dd($recipe);
      return redirect()->route('recipes.index');
  }

  public function destroy(Recipe $recipe)
  {
    // 削除する画像名を取得
    $delete_image = $recipe->image_path;
    // dd($delete_image);
    // 削除する画像が存在しているディレクトリのパスを取得
    $delete_path = storage_path().'/app/public/images/'.$delete_image;
    // dd($delete_path);
    // $delete_pathに入っている画像パスと一致する画像データを削除
    \File::delete($delete_path);
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


