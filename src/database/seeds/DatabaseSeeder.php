<?php

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

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
        Model::unguard(); 
        // 外部キー制約を無効にする
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // db:seedでデータベースに登録される
        $this->call([
          UsersTableSeeder::class,
          CategoriesTableSeeder::class,
          // RecipesTableSeeder::class,
        ]);

        // 外部キー制約を最有効化
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // セキュリティを再設定
        Model::reguard();
    }
}
