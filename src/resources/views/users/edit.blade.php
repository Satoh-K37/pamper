@extends('app')

@section('title')
    プロフィール編集
@endsection

@section('content')
  @include('nav')
    <div id="profile-edit-form" class="container">
        <div class="row">
            <div class="col-8 offset-2 bg-white">
                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール編集</div>
                <form method="POST" class="p-5" action="{{ route('users.update',[$user->name]) }}" enctype="multipart/form-data">
                    @csrf
                    {{-- アイコン --}}
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

                    {{-- ニックネーム --}}
                    <div class="form-group mt-3">
                        <label for="name">ニックネーム</label>
                        <input maxlength="50" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <!-- <strong>{{ $message }}</strong> -->
                        </span>
                        @enderror
                    </div>
                    <!-- <div class="form-group mt-3">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="text" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> -->

                    <div class="form-group mt-3">
                        <label for="self_introduction">自己紹介</label>
                        
                        <textarea  maxlength="150" id="self_introduction" name="self_introduction" style="height: 100px;" class="form-control">{{ old('self_introduction', $user->self_introduction) }}</textarea>

                        <!-- @error('name')
                        <span class="invalid-feedback" role="alert">
                        </span>
                        @enderror -->
                    </div>

                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-secondary">
                            保存
                        </button>
                    </div>
                </form>
                @if (Auth::id() == 1)
                  <!-- ゲストユーザーの場合はパスワード変更のリンクを表示させないようにする -->
                @else
                  <div class="text-right">
                    <a href="{{ route('password.form', ['name' => $user->name]) }}" >
                      パスワードの変更
                    </a>
                  </div>
                @endif
            </div>
        </div>
    </div>
@endsection
<!-- 
                    <div class="form-group mb-0 mt-3">
                      <a href="{{ route('password.form', ['name' => $user->name]) }}">
                        <button class="btn blue-gradient btn-block" >
                        <button class="btn blue-gradient btn-block" style="width: 25%; padding: 10px;">
                          {{ __('Change Password') }}
                          パスワードの変更
                        </button>
                      </a>
                    </div> -->