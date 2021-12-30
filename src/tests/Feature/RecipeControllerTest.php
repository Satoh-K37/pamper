<?php
namespace Tests\Feature;

use App\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

// テストは準備・実行・検証の順に書くといいらしい

class RecipeControllerTest extends TestCase
{
  use RefreshDatabase;
  // レシピ一覧画面のテスト
  public function testIndex()
  {
      $response = $this->get(route('recipes.index'));

      $response->assertStatus(200)
      // HTTPレスポンスの正常レスポンスを示す200が$responseに渡されていればテストに成功
          ->assertViewIs('recipes.index');
  }


  // ログインしていないときに投稿ボタンを押すとログイン画面に遷移するかをテスト
  public function testGuestCreate()
  {
      $response = $this->get(route('recipes.create'));

      $response->assertRedirect(route('login'));
  }

  // ログインしている状態で投稿ボタンを押すと投稿画面が正しく表示されるかをテスト
  public function testAuthCreate()
  {
    // テスト用のユーザーをfactory関数を使って作成「準備」
      $user = factory(User::class)->create();

      // actingAsメソッドを使用して、先ほど作ったユーザーでログインを行う（ログインした状態にする）「実行」
      $response = $this->actingAs($user)
          ->get(route('recipes.create'));

      // actingAsメソッドでログイン状態にした状態で投稿画面にアクセスして問題がなければHTTPステータスコード200が返ってくるかをテスト
      // レスポンスを「検証」
      $response->assertStatus(200)
          ->assertViewIs('recipes.create');
  }

  // いいねされているかをテスト
  public function likes(): BelongsToMany
  {
      return $this->belongsToMany('App\User', 'likes')->withTimestamps();
  }

  public function isLikedBy(?User $user): bool
  // 引数に?Userとすることで引数がNULLであることを許容すると宣言している
  {
      return $user
          // $userがNULLでなければ下の結果を呼び出し元に返す
          ? (bool)$this->likes->where('id', $user->id)->count()
          // $userがNULLならfalseを返す
          : false;
  }

}