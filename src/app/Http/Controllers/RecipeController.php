<?php


namespace App\Http\Controllers;

use App\Recipe;
use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
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
      // $recipe->recipe_title = $request->recipe_title;
      // $recipe->content = $request->content;
      // $recipe->serving = $request->serving;
      // $recipe->ingredient = $request->ingredient;
      // $recipe->seasoning = $request->seasoning;
      // $recipe->step_content	 = $request->step_content;
      // $recipe->step_content2 = $request->step_content2;
      // $recipe->step_content3 = $request->step_content3;
      // $recipe->step_content4 = $request->step_content4;
      // $recipe->step_content5 = $request->step_content5;
      // $recipe->step_content6 = $request->step_content6;
      // $recipe->cooking_point = $request->cooking_point;

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

}
