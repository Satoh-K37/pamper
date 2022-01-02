<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Laravelはある程度固まったデータを挿入できないのでセキュリティ解除
        // Model::unguard(); 
        // $this->call(UsersTableSeeder::class);
        // db:seedでデータベースに登録される
        $this->call([
          CategoriesTableSeeder::class,
          UsersTableSeeder::class,
          // RecipesTableSeeder::class,
        ]);

      // セキュリティを再設定
      // Model::reguard();
    }
}
