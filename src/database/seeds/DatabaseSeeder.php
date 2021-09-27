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
        // $this->call(UsersTableSeeder::class);
        // db:seedでデータベースに登録される
        $this->call([
          CategoriesTableSeeder::class,
        ]);
    }
}
