@extends('app')

@section('title')
    プロフィール編集
@endsection

@section('content')
  @include('nav')
    <div id="profile-edit-form" class="container">
      @include('error_card_list')
      @include('flash_message')
        <div class="container my-3">
          <div class="row">

            <div class="col-md-8 col-lg-8 mx-auto">
              <!-- <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">
                プロフィール編集
              </div> -->
                <form method="POST" class="p-5" action="{{ route('users.update',[$user->name]) }}" enctype="multipart/form-data">
                  @csrf
                  <!-- Card -->
                  <div class="card testimonial-card">
                    <!-- Background color -->
                    <div class="card-up warning-color-dark p-3 white-text">
                      <a onclick="history.back(-1);return false;">
                        <i class="fas fa-arrow-left"></i>
                      </a>
                      <span class="font-weight-normal ml-3">プロフィールを編集する</span>
                    </div>
                    <!-- Avatar -->
                    <!-- <div class="avatar mr-auto white"> -->
                    <div class="d-flex flex-row mx-auto my-3">
                          <span class="avatar-form image-picker">
                              <input type="file" name="profile_image" class="d-none"  id="profile_image"/>
                              <label for="profile_image" class="d-inline-block">
                              @if($user->profile_image !== NULL)
                                <img src="/storage/icons/{{$user->profile_image}}" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                              @else
                                <img src="/storage/default_icon.png" class="rounded-circle" style="object-fit: cover; width: 200px; height: 200px;">
                              @endif
                              </label>
                          </span>
                    </div>
                    <div class="form-group mx-3 my-2">
                        <div class="md-form">
                          <input maxlength="50" type="text" id="name" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                          <label for="name">名前</label>
                        </div>
                    </div>

                    <div class="form-group mx-3">
                        <div class="md-form">
                          <textarea id="self_introduction" maxlength="150" name="self_introduction" class="md-textarea form-control" rows="3">{{ old('self_introduction', $user->self_introduction) }}</textarea>
                          <label for="self_introduction">自己紹介</label>
                        </div>
                    </div>
                    
                    <div class="form-group mx-2 text-center">
                      <button type="submit" class="btn btn-outline-dark rounded w-75"  data-mdb-ripple-color="dark">
                        保存
                      </button>
                    </div>

                  <!-- </div> -->
                  <!-- Card end-->
              <!-- </form> -->
                    <div class="card-body px-3 py-4">
                      <div class="row">
                        @if (Auth::id() == 1)
                            <!-- ゲストユーザーの場合はパスワード変更のリンクを表示させないようにする -->
                        @else
                          <a href="{{ route('password.form', ['name' => $user->name]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                              <dt>パスワードの変更</dt>
                              <dd class="mb-0"></dd>
                            </dl>
                            <div><i class="fas fa-chevron-right"></i></div>
                          </a>
                          <a href="{{ route('email_change.form', ['name' => $user->name]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <dl class="mb-0">
                              <dt>メールアドレスの変更</dt>
                              <dd class="mb-0"></dd>
                            </dl>
                            <div><i class="fas fa-chevron-right"></i></div>
                          </a>
                        @endif
                      </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection