<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Recipe;
use App\User;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
      'recipe_title' => $faker->text(50),
      'content' => $faker->text(500),
      'serving' => $faker->randomDigit(5),
      'ingredient' => $faker->string(255),
      'seasoning' => $faker->string(255),
      'step_content' => $faker->string(255),
      'step_content2' => $faker->string(255),
      'step_content3' => $faker->string(255),
      'step_content4' => $faker->string(255),
      'step_content5' => $faker->string(255),
      'step_content6' => $faker->string(255),
      'cooking_time' => $faker->randomDigit(5),
      'user_id' => function() {
          return factory(App/User::class);
      }
    ];
});
