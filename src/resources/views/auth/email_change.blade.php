<form action="{{ route('email.change')}}" method="post" enctype="multipart/form-data">

 {{ csrf_field() }}

  <div class="form-contents">
    <div class="form-one-size">
      <div class="form-input">
        <div class="form-label">
          メールアドレス
        </div>
        <div>
          <input class="form-input__input" type="text" name="email"value="{{$auth->email}}">
        </div>
      </div>
    </div>
  </div>

  <div class="form-foot">
    <input class="send" type="submit" value="編集">
  </div>

</form>
