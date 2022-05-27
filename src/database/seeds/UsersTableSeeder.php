<?php

use Illuminate\Database\Seeder;
use App\User;
// use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

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
      DB::table('users')->truncate();

      // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

      static $password;
      $guest_user = User::create([
        'name' => 'ゲストユーザー',
        'email' => 'guestuser@test.com',
        'password' => $password ?: $password = bcrypt('secret'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);
      
      DB::table('users')->insert([
        'name' => 'UserName1',
        'email' => 'User1@mailaddress.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);

      DB::table('users')->insert([
        'name' => 'UserName2',
        'email' => 'User2@mailaddress.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);

      DB::table('users')->insert([
        'name' => 'UserName3',
        'email' => 'User3@mailaddress.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);

      DB::table('users')->insert([
        'name' => 'UserName4',
        'email' => 'User4@mailaddress.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);

      DB::table('users')->insert([
        'name' => 'UserName5',
        'email' => 'User5@mailaddress.com',
        'password' => bcrypt('password'),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
      ]);

    }
}