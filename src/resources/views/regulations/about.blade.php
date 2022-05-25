@extends('app')
@section('title', 'SPOILYについて')
@section('content')
  <!--Main layout-->
  <main>
    <div class="container">
      <!--Section: Main info-->
      <section class="mt-5 wow fadeIn">
        <!--Grid row-->
        <div class="row">
          <!--Grid column-->
          <div class="col-md-6 mb-4">
            <!--Image-->
            @if(app()->isLocal() || app()->runningUnitTests())
              <div class="view overlay mw-100">
                <img src="/storage/about_recipes_search.png" class="img-fluid h-100">
                <a>
                  <div class="mask rgba-white-light"></div>
                </a>
              </div>
            @else
              <div class="view overlay mw-100">
                <img src='{{ Storage::disk('s3')->url("about_recipes_search.png")}}' class="img-fluid h-100">
                <a>
                  <div class="mask rgba-white-light"></div>
                </a>
              </div>
            @endif
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-md-6 my-5">
            <!-- Main heading -->
            <h3 class="h3 font-weight-bold my-1">SPOILYは、あなたのご褒美ごはんを共有するサービスです</h3>

            <div class="my-5 py-5 btn-flat-double-border">
              <div class="text-center">
                <a href="{{ route('register') }}" class="btn btn-outline-danger" data-mdb-ripple-color="#000000">
                  SPOILYをはじめる
                </a>
              </div>
            </div>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </section>
      <!--Section: Main info-->
      <hr class="my-5">
      <!--Section: Main features & Quick Start-->
      <section>
        <h3 class="h3 font-weight-bold text-center my-5">頑張った自分へのご褒美をみんなにシェアしよう</h3>
        <!--Grid row-->
        <div class="row wow fadeIn">
          <!--Grid column-->
          <div class="col-lg-6 col-md-12 px-4 my-5">
            <!--First row-->
            <div class="row">
              <div class="col-1 mr-3">
                <i class="far fa-check-circle fa-2x" style="color: #F9A826"></i>
                <!-- <i class="fas fa-check-circle"></i> -->

              </div>
              <div class="col-10">
                <h5 class="feature-title">ご褒美ごはんの写真を共有しよう</h5>
                <p class="grey-text">一番美味しそうな角度で撮ってみんなにシェア！</p>
              </div>
            </div>
            <!--/First row-->

            <div style="height:30px"></div>

            <!--Second row-->
            <div class="row">
              <div class="col-1 mr-3">
                <i class="far fa-check-circle fa-2x" style="color: #F9A826"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">タイトルや作り方をみんなに共有しよう</h5>
                <p class="grey-text">
                  ご褒美がどんなものなのかすぐにわかるタイトルや作り方をみんなにシェア！
                </p>
              </div>
            </div>
            <!--/Second row-->

            <div style="height:30px"></div>

          </div>
          <!--/Grid column-->

          <!--Grid column-->
          <div class="col-lg-6 col-md-12">
            <div class="col-md flex-center">
                            <!--Image-->
              @if(app()->isLocal() || app()->runningUnitTests())
                <div class="view overlay mw-100">
                  <img src="/storage/about_share.png" class="img-fluid h-100">
                  <a>
                    <div class="mask rgba-white-light"></div>
                  </a>
                </div>
              @else
                <div class="view overlay mw-100">
                  <img src='{{ Storage::disk('s3')->url("about_share.png")}}' class="img-fluid h-100">
                  <a>
                    <div class="mask rgba-white-light"></div>
                  </a>
                </div>
              @endif
              
            </div>
          </div>
          <!--/Grid column-->
        </div>
        <!--/Grid row-->
      </section>
      <!--Section: Main features & Quick Start-->

      <hr class="my-5">

      <!--Section: Not enough-->
      <section>

        <h2 class="my-5 h3 font-weight-bold text-center">SPOILYを使って、マンネリにさようなら</h2>

        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--Second column-->
          <div class="col-md-6 flex-center">
                          <!--Image-->
            @if(app()->isLocal() || app()->runningUnitTests())
              <div class="view overlay mw-100">
                <img src="/storage/about_likes.png" class="img-fluid h-100">
                <a>
                  <div class="mask rgba-white-light"></div>
                </a>
              </div>
            @else
              <div class="view overlay mw-100">
                <img src='{{ Storage::disk('s3')->url("about_likes.png")}}' class="img-fluid h-100">
                <a>
                  <div class="mask rgba-white-light"></div>
                </a>
              </div>
            @endif
          </div>
          <!--/Second column-->

          <!--Third column-->
          <div class="col-md-6 mt-2 my-5">
            <!--First row-->
            <div class="row">
              <div class="col-1 mr-2">
                <i class="far fa-check-circle fa-2x" style="color: #F9A826"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">検索機能で、きになるご褒美ごはんをみつけよう！</h5>
                <p class="grey-text">カテゴリやキーワードからきになるご褒美ごはんを見つけることができます
                </p>
                <div style="height:30px"></div>
              </div>
            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
              <div class="col-1 mr-2">
                <i class="far fa-check-circle fa-2x" style="color: #F9A826"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">みんなの投稿をみてご褒美ごはんのレパートリを増やそう！</h5>
                <p class="grey-text">みんなのご褒美ごはんがいつでも見ることができます</p>
                <div style="height:30px"></div>
              </div>
            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              <div class="col-1 mr-2">
                <i class="far fa-check-circle fa-2x" style="color: #F9A826"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">気に入った投稿は「いいね」しよう</h5>
                <p class="grey-text">気に入ったご褒美ごはんがあった場合は「いいね」しておきましょう。いいねした投稿はマイページから見返すことができます
                </p>
                <div style="height:30px"></div>
              </div>
            </div>
            <!--/Third row-->
            <!--/Fourth row-->
          </div>
          <!--/Third column-->

        </div>
        <!--/First row-->

      </section>
      <!--Section: Not enough-->

    </div>
  </main>
  <!--Main layout-->
@endsection