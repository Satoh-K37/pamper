
<!-- 非表示の項目を開くときに使ってるアイコン -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@csrf
<div class='md-form'>
  <label>レシピタイトル *</label>
  <input type="text" name="recipe_title" class="form-control" required value="{{ $recipe->recipe_title ?? old('recipe_title') }}">
</div>

<div class="form-group">
  <label></label>
    <textarea name="content" required class="form-control" rows="10" placeholder="ご褒美ご飯は何にした？">{{ $recipe->content ?? old('content') }}</textarea>
</div>

<div class="form-group">
  <div class="form-input__picture afterimage">
    <!-- image_pathの中身がNULLじゃない場合は画像を表示させる -->
    @if (isset($recipe->image_path))
      <div class="card-text">
        <img src="/storage/images/{{$recipe->image_path}}">
      </div>
    @else
      <div class="card-text">
        <span class="form-input__image_path--text">画像が登録されていません</span>
      </div>
    @endif
  </div>
</div>
  
@if(Route::is('recipes.edit'))
  <div class="form-group">
    <div class="card-text">
      <input type="file" name="image_path">
      <!-- <image-preview></image-preview> -->
    </div>
  </div>
@else
  <div class="form-group">
    <div class="card-text">
      <input type="file" name="image_path" required>
      <!-- <image-preview></image-preview> -->
    </div>
  </div>
@endif

<div class="hidden_box">
  <input type="checkbox" id="label1"/>
  <label for="label1">材料、調味料</label>
  <div class="hidden_show">
    <!--非表示ここから-->
    <div class="form-group">
      <select class="form-control" name="serving">
        @foreach ($servings as $serving => $serving_name)
              <!-- <option value="{{ $serving }}"> -->
          <option value="{{ $serving }}" {{ old('serving_name', $recipe->serving ?? '') == $serving ? 'selected' : ''}}>
              {{ $serving_name }}
          </option>
        @endforeach
      </select>
    </div>
    
    <textarea name="ingredient" class="form-control" required placeholder="材料">{{ $recipe->ingredient ?? old('ingredient') }}</textarea>
    <textarea name="seasoning" class="form-control" required placeholder="調味料">{{ $recipe->seasoning ?? old('seasoning') }}</textarea>
    <!--ここまで-->
  </div>
</div>


  <div class="hidden_box">
    <input type="checkbox" id="label2"/>
    <label for="label2">調理手順</label>
    <div class="hidden_show">

      <div class="md-outline">
        <textarea placeholder="Step1" rows="4" name="step_content" class="form-control">{{ $recipe->step_content ?? old('step_content') }}</textarea>
      </div>

      <div class="mform-outline">
        <textarea placeholder="Step2" rows="4" name="step_content2" class="form-control">{{ $recipe->step_content2 ?? old('step_content2') }}</textarea>
      </div>

      <div class="md-outline">
        <textarea placeholder="Step3" rows="4" name="step_content3" class="form-control">{{ $recipe->step_content3 ?? old('step_content3') }}</textarea>
      </div>

      <div class="md-outline">
        <textarea placeholder="Step4" rows="4"name="step_content4" class="form-control">{{ $recipe->step_content4 ?? old('step_content4') }}</textarea>
      </div>

      <div class="md-outline">
        <textarea placeholder="Step5" rows="4" name="step_content5" class="form-control">{{ $recipe->step_content5 ?? old('step_content5') }}</textarea>
      </div>

      <div class="md-outline">
        <textarea placeholder="Step6" rows="4" name="step_content6" class="form-control">{{ $recipe->step_content6 ?? old('step_content6') }}</textarea>
      </div>
    </div>
  </div>      


<div class="md-form">
  <label>コツ・ポイント</label>
  <input type="text" name="cooking_point" class="form-control" value="{{ $recipe->cooking_point ?? old('cooking_point') }}">
</div>
<div class="form-group">
  <recipe-tags-input
  :initial-tags='@json($tagNames ?? [])'
  :autocomplete-items='@json($allTagNames ?? [])'
  >
  </recipe-tags-input>
</div>

<div class="form-group">
  <label for="cooking_time">調理時間</label>
  <select class="form-control" name="cooking_time">
    @foreach ($cooking_times as $cooking_time => $time)
          <!-- <option value="{{ $serving }}"> -->
      <option value="{{ $cooking_time }}" {{ old('time', $recipe->cooking_time ?? '') == $cooking_time ? 'selected' : ''}}>
          {{ $time }}
      </option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="category_id">カテゴリ *</label>
  <select class="form-control" name="category_id" required>
    
    @foreach ($categories as $id => $name)
      <option value="{{ $id }}" {{ old('category', $old_category_id->id ?? '') == $id ? 'selected' : ''}}>
          {{ $name }}
      </option>
    @endforeach
  </select>
</div>


