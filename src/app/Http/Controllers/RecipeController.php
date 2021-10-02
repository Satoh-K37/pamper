<?php


namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use App\Category;

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
      $allTagNames = Tag::all()->map(function ($tag) {
          return ['text' => $tag->name];
      });
      
      // $allCategoryNames = Category::all()->map(function ($category) {
      //   return ['text' => $category->name];
      // });

      // $allCategoryNames = Category::pluck('name', 'id');
      $allCategoryNames = Category::all();
      $category = new Category;
      $categories = $category->getCategories();



      return view('recipes.create', [
          'allTagNames' => $allTagNames,
          'allCategoryNames' => $allCategoryNames,
          'categories' => $categories,
      ]);

  }

  public function store(RecipeRequest $request, Recipe $recipe)
  {
      // dd($request);
      $recipe->fill($request->all());
      // $recipe->categories()->sync($request->id);
      $recipe->user_id = $request->user()->id;
      $recipe->save();

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

      // $allCategoryNames = Category::pluck('name', 'id');
      $allCategoryNames = Category::all();
      // $inputCategory = $recipe->category_id;
      $category = new Category;
      
      $categories = $category->getCategories()->prepend('選択してください', '');
      $recipeId = Recipe::find($recipe->id)->categories()->where('recipe_id', '=', $recipe->id)->get();
      // $category_id = $recipeId->id;
    
      // $category_id = Recipe::find($recipe->id)->categories('category_id')->where('category_recipe.recipe_id', '=', $recipe->id)->get();
      // $categoryId = App\Recipe::find($recipe->id)->categories()->where('category_recipe.recipe_id', '=', $recipe->id)->get();
      // var_dump($category_id);
      // $query = Recipe::query();
      
      print_r($recipeId);
      // 受け取った$recipeに入ってるrecipe_idを使ってcategory_recipeテーブルに検索をかけて、レシピに紐づいてるcategory_idを取得し、変数に代入
      // 変数に保存されているcategory_idとcategoriesのデータを照らし合わせる
      // $category_id = DB::table('category_recipe')->select(DB::raw('SELECT * FROM `categories` WHERE `recipe_id` = $recipe->id'));


      return view('recipes.edit', [
        'recipe' => $recipe,
        'tagNames' => $tagNames,
        'allTagNames' => $allTagNames,
        'allCategoryNames' => $allCategoryNames,
        // 'inputCategory' => $inputCategory,
        'categories' => $categories,
        // 'category_id' => $category_id,
      ]);
  }

  public function update(RecipeRequest $request, Recipe $recipe)
  {
      // dd($request);
      // $inputCategory = $request->category;

      $recipe->fill($request->all())->save();
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


