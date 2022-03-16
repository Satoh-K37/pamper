<div class="container mt-3">
  <div class="row">
    <div class="col-md-8 col-lg-12 mx-auto">
      <!-- Section: Block Content -->
      <section>
        <!-- Card -->
        <div class="card testimonial-card">　
            <!-- Background color -->
            <div class="card-up p-3 white-text" style="background: #fca326">
              <a onclick="history.back(-1);return false;">
                <i class="fas fa-arrow-left"></i>
              </a>
              <a class="font-weight-normal ml-3">{{ $user->name }}</a>
            </div>
            <div class="d-flex flex-row my-2 mx-2">
              @if(app()->isLocal() || app()->runningUnitTests())
                <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                  @if($user->profile_image !== NULL)
                    <!-- <img src="/storage/icons{{$user->profile_image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;"> -->
                    <img src='/storage/icons/{{$user->profile_image}}' class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
                  @else
                    <img src='/storage/default_icon.png' class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
                  @endif
                </a>
              @else
                <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                  @if($user->profile_image !== NULL)
                    <!-- <img src="/storage/icons{{$user->profile_image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;"> -->
                    <img src="{{ Storage::disk('s3')->url("$user->profile_image") }}" class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
                  @else
                    <img src="{{ Storage::disk('s3')->url("default_icon.png") }}" class="rounded-circle" style="object-fit: cover; width: 100px; height: 100px;">
                  @endif
                </a>
              @endif

              @if( Auth::id() !== $user->id )
                <follow-button
                  class="ml-auto"
                  :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                  :authorized='@json(Auth::check())'
                  endpoint="{{ route('users.follow', ['name' => $user->name]) }}"
                >
                </follow-button>
              @else
                <div class="ml-auto">
                  <a href="{{ route('users.edit', ['name' => $user->name] )}}">
                    <button class="btn btn-outline-dark btn-rounded p-2" id="btn-radius">
                      プロフィール編集
                    </button>
                  </a>
                </div>
              @endif
            </div>
            <!-- </div> -->
            <h2 class="h5 card-title ml-3">
              <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                {{ $user->name }}
              </a>
            </h2>
            <p class="text-dark mx-3">
                {{ $user->self_introduction }}
            </p>


            <!-- Content -->
            <div class="card-body px-3 py-4">
              <div class="row">
                <div class="col-4 text-center">
                  <p class="font-weight-bold mb-0 text-muted">{{ $recipes->count() }}</p>
                  <p class="small text-uppercase mb-0">件の投稿</p>
                </div>
                <div class="col-4 text-center border-left border-right">
                  <a class="font-weight-bold mb-0 text-muted" href="{{ route('users.followings', ['name' => $user->name]) }}">
                    {{ $user->count_followings }}
                  </a>
                  <p class="small text-uppercase mb-0">フォロー</p>
                </div>
                <div class="col-4 text-center">
                  <a class="font-weight-bold mb-0 text-muted" href="{{ route('users.followers', ['name' => $user->name]) }}">
                    {{ $user->count_followers }}
                  </a>
                  <p class="small text-uppercase mb-0">フォロワー</p>
                </div>
              </div>
            </div>
        </div>
          <!-- Card -->

      </section>
      <!-- Section: Block Content -->


    </div>
  </div>
</div>