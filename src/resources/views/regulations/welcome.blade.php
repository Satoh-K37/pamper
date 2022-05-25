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
                <img src="/storage/logo.png" class="img-fluid h-100">
                <a>
                  <div class="mask rgba-white-light"></div>
                </a>
              </div>
            @else
              <div class="view overlay mw-100">
                <img src='{{ Storage::disk('s3')->url("logo.png")}}' class="img-fluid h-100">
                <a>
                  <div class="mask rgba-white-light"></div>
                </a>
              </div>
            @endif
          </div>
          <!--Grid column-->
          <!--Grid column-->
          <div class="col-md-6 mb-4">
            <!-- Main heading -->
            <h3 class="h3 mb-3">SPOILYは、あなたのご褒美ごはんを共有するサービスです</h3>

            <!-- CTA -->
            <p>
              <a target="_blank" href="{{ route('register') }}" class="btn btn-indigo btn-md">
                SPOILYをはじめる
                <i class="fas fa-download ml-1"></i>
                
              </a>
            </p>
          </div>
          <!--Grid column-->
        </div>
        <!--Grid row-->
      </section>
      <!--Section: Main info-->
      <hr class="my-5">
      <!--Section: Main features & Quick Start-->
      <section>
        <h3 class="h3 text-center mb-5">頑張った自分へのご褒美をみんなにシェアしよう</h3>
        <!--Grid row-->
        <div class="row wow fadeIn">
          <!--Grid column-->
          <div class="col-lg-6 col-md-12 px-4">
            <!--First row-->
            <div class="row">
              <div class="col-1 mr-3">
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
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
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h5 class="feature-title">タイトルや作り方をみんなに共有しよう</h5>
                <p class="grey-text">
                  ご褒美がどんなものなのかすぐにわかるタイトルや作り方をみんなにシェア！
                </p>
              </div>
            </div>
            <!--/Second row-->


          </div>
          <!--/Grid column-->

          <!--Grid column-->
          <div class="col-lg-6 col-md-12">

            <p class="h5 text-center mb-4"></p>
            <div class="embed-responsive embed-responsive-16by9">
              <!-- <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/cXTThxoywNQ" allowfullscreen></iframe> -->
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

        <h2 class="my-5 h3 text-center">SPOILYを使って、マンネリにさようなら</h2>

        <!--First row-->
        <div class="row features-small mb-5 mt-3 wow fadeIn">

          <!--Second column-->
          <div class="col-md-6 flex-center">
            <!-- <img src="https://mdbootstrap.com/img/Others/screens.png" alt="MDB Magazine Template displayed on iPhone" class="z-depth-0 img-fluid"> -->
          </div>
          <!--/Second column-->

          <!--Third column-->
          <div class="col-md-6 mt-2">
            <!--First row-->
            <div class="row">
              <div class="col-2">
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title">検索機能で、きになるご褒美ごはんをみつけよう！</h6>
                <p class="grey-text">カテゴリやキーワードからきになるご褒美ごはんを見つけることができます
                </p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/First row-->

            <!--Second row-->
            <div class="row">
              <div class="col-2">
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title">みんなの投稿をみてご褒美ごはんのレパートリを増やそう！</h6>
                <p class="grey-text">みんなのご褒美ごはんがいつでも見ることができます！</p>
                <div style="height:15px"></div>
              </div>
            </div>
            <!--/Second row-->

            <!--Third row-->
            <div class="row">
              <div class="col-2">
                <i class="fas fa-check-circle fa-2x indigo-text"></i>
              </div>
              <div class="col-10">
                <h6 class="feature-title">気に入った投稿はいいね！しよう</h6>
                <p class="grey-text">気に入ったご褒美ごはんがあった場合はいいね！しておきましょう。いいねした投稿はマイページから見返すことができます
                </p>
                <div style="height:15px"></div>
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