<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
  public function index()
  {
      // ダミーデータ
      $recipes = [
          (object) [
              'id' => 1,
              'recipe_name' => 'レシピ名1',
              'content' => '本文1',
              'created_at' => now(),
              'user' => (object) [
                  'id' => 1,
                  'name' => 'ユーザー名1',
              ],
          ],
          (object) [
              'id' => 2,
              'recipe_name' => 'レシピ名2',
              'content' => '本文2',
              'created_at' => now(),
              'user' => (object) [
                  'id' => 2,
                  'name' => 'ユーザー名2',
              ],
          ],
          (object) [
              'id' => 3,
              'recipe_name' => 'レシピ名3',
              'content' => '本文3',
              'created_at' => now(),
              'user' => (object) [
                  'id' => 1,
                  'name' => 'ユーザー名3',
              ],
          ],
      ];

      return view('recipes.index', ['recipes' => $recipes]);
  }
}
