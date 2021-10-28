<?php


namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Recipe;
use App\Tag;
use App\Category;

class RecipeController extends Controller
{
  public function __construct()
  {
      $this->authorizeResource(Recipe::class, 'recipe');
  }

  public function index(Request $request)
  {
      // $allCategoryNames = Category::all();
      $category = new Category;
      $categories = $category->getCategories()->prepend('選択してください', '');

      $keyword = $request->input('keyword');
      $category_id = $request->input('category_id');
      $query = Recipe::query();
        #もしキーワードがあったら
      // if(!empty($keyword))
      // {
      //   // 
      //   $query->where('recipe_title','like','%'.$keyword.'%')
      //   ->orWhere('content','like','%'.$keyword.'%');
      // }
      // dd($recipes);
      // $keywordがない場合は全検索を実行する
      $recipes = $query->orderBy('created_at','desc')->paginate(10);
      // $recipes = Recipe::all()->sortByDesc('created_at');
      return view('recipes.index', [
        'recipes' => $recipes,
        // 'allCategoryNames' => $allCategoryNames,
        'categories' => $categories,
        'keyword' => $keyword,
        'category_id' => $category_id,
        ]);
  }

  // 検索
  public function search(Request $request)
  {
    // dd($request->get('id'));
    // 検索フォームに入力されたキーワードを受け取る
    $keyword = $request->input('keyword');
    // 検索時に選択されたcategory_idを受け取る
    $category_id = $request->input('category_id');
    $query = Recipe::query();

    // dd($category_id);
    // dd($keyword);
    #もしキーワードが存在している場合は処理を行う
    if(!empty($keyword))
    {
      // recipeタイトルと本文にフォームに入力されたキーワードと部分一致するものがあれば取得する
      $query->where('recipe_title','like','%'. $keyword .'%')
      ->orWhere('content','like','%'. $keyword .'%');
      
    }

    // カテゴリーのIDが存在している場合に処理を行う。
    if(!empty($category_id)){
      $query->whereHas('categories', function ($query) use ($category_id) {
        $query->where('categories.id', $category_id);
      });
    }

    // $keywordがない場合は全検索を実行する
    $result_recipes = $query->orderBy('created_at','desc')->paginate(10);
    
    $category = new Category;
    $categories = $category->getCategories()->prepend('選択してください', '');
    
    $old_category_id = $category_id;
    // dd($old_category_id);
    

    return view('recipes.searchresult', [
      'result_recipes' => $result_recipes,
      'keyword' => $keyword,
      'categories' => $categories,
      'category_id' => $category_id,
      'old_category_id' => $old_category_id,
      ]);
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
      // リクエストデータを受け取る
      $form = $request->all();
      // フォームトークン削除。
      unset($form['_token']);
      // 画像データがあるかを確認
      if(isset($form['image_path'])){
          // 削除する画像名を取得
          $delete_image = $recipe->image_path;
          // 削除する画像が存在しているディレクトリのパスを取得
          $delete_path = storage_path().'/app/public/images/'.$delete_image;
          // $delete_pathに入っている画像パスと一致する画像データを削除
          \File::delete($delete_path);

          $file = $request->image_path;
          // dd($file);
          // アップロードされた画像の拡張子の取得。getClientOriginalExtension();だとできなかった…なぜ？
          // $ext = pathinfo($file, PATHINFO_EXTENSION);
          $ext = $request->file('image_path')->getClientOriginalExtension();
          // dd($ext);
          // ファイル名をランダムで作成
          $file_token = Str::random(32);
          // ファイル名と取得した拡張子を合体
          $imageFile = $file_token.".".$ext;
          // $formのimage_pathにファイル名と取得した拡張子を合体した物を代入する。保存する時に使う
          $form['image_path'] = $imageFile;
          // storeAsでオリジナルの画像名をつけて、指定のディレクトリに画像を保存
          $request->image_path->storeAs('public/images/', $imageFile);
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

  // static として宣言することで、 クラスのインスタンス化の必要なしにアクセスすることができるようになる
  // static プロパティは、矢印演算子 -> によりオブジェクトからアクセス することはできないらしい

  //「\\」「%」「_」などの記号を文字としてエスケープさせる
  // セキュリティに必要らしいんだけどイマイチ理解できないので一旦コメントアウトしておく。
  // $query->where('recipe_title','like','%'. $keyword .'%')これでエスケープできてるっぽい
  //参照：https://qiita.com/horikeso/items/393663f1bffe63bd937e
  // public static function escapeLike($str)
  // {
  //     return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
  // }

}


