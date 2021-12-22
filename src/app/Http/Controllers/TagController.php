<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Recipe;
use App\Category;

class TagController extends Controller
{
  public function show(string $name ,Request $request)
  {
      $category = new Category;
      $categories = $category->getCategories()->prepend('選択してください', '');

      $keyword = $request->input('keyword');
      $category_id = $request->input('category_id');
      $query = Recipe::query();
      $recipes = $query->orderBy('created_at','desc')->paginate();
      $tag = Tag::where('name', $name)->first();

      return view('tags.show', [
        'tag' => $tag,
        'recipes' => $recipes,
        'categories' => $categories,
        'keyword' => $keyword,
        'category_id' => $category_id,
        ]);
  }
}
