<?php

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //一括削除
      // DB::table('recipes')->truncate();
      // $recipes = factory(App\Recipe::class, 10)->create();
    }
}
