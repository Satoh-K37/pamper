<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //一括削除
      // User::truncate();
      // LaravelはDBに固まったデータを登録できないのでセキュリティを外す
      User::unguard();

      DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      static $password;
      $guest_user = User::create([
        'name' => 'ゲストユーザー',
        'email' => 'guestuser@test.com',
        'email_verified_at' => now(),
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => Str::random(10),
      ]);

      factory(App\User::class,100)->create()->each(function($user){
          // $recipe = new App\Recipe();
          // $recipe->user_id = $user->id;
          // $recipe->recipe_title = 'デモ';
          // $recipe->serving = 1;
          // $recipe->cooking_time = 1;
          // $recipe->save();
      });
      DB::statement('SET FOREIGN_KEY_CHECKS=1;');
      // セキュリティの掛け直し
      User::reguard();

    }
}
