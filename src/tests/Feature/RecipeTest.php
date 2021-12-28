<?php

namespace Tests\Feature;

use App\Recipe;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecipeTest extends TestCase
{
  use RefreshDatabase;

  public function testIsLikedByNull()
  {
      $recipe = factory(Recipe::class)->create();

      $result = $recipe->isLikedBy(null);

      $this->assertFalse($result);
  }

  // いいねをしている場合のテスト
  public function testIsLikedByTheUser()
  {
      $recipe = factory(Recipe::class)->create();
      $user = factory(User::class)->create();
      $recipe->likes()->attach($user);

      $result = $recipe->isLikedBy($user);

      $this->assertTrue($result);
  }

  // いいねをしていない場合のテスト
  public function testIsLikedByAnother()
  {
      $recipe = factory(Recipe::class)->create();
      $user = factory(User::class)->create();
      $another = factory(User::class)->create();
      $recipe->likes()->attach($another);

      $result = $recipe->isLikedBy($user);

      $this->assertFalse($result);
  }

}
