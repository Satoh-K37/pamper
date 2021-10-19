@csrf
<div class="md-form">
  <label>レシピタイトル *</label>
  <input type="text" name="recipe_title" class="form-control" required value="{{ $recipe->recipe_title ?? old('recipe_title') }}">
</div>


<div class="form-group">
  <label></label>
  <textarea name="content" required class="form-control" rows="10" placeholder="今日は何を食べた？">{{ $recipe->content ?? old('content') }}</textarea>
</div>

<div class="form-group">
  <div class="form-input__picture afterimage">
    <!-- image_pathの中身がNULLじゃない場合は画像を表示させる -->
    @if (isset($recipe->image_path))
      <img src="{{ asset("storage/$recipe->image_path") }}"  width="1000" height="300">
      <div class="card-text">
        <!-- <file-upload></file-upload> -->
        <input type="file" name="image_path">
      </div>
    @else
      <span class="form-input__image_path--text">画像が登録されていません</span>
      <div class="card-text">
        <!-- <file-upload></file-upload> -->
        <input type="file" name="image_path">
      </div>
    @endif
  </div>
</div>


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
<div class="md-form">
  <!-- <p>材料:</p> -->
  <label>材料</label>
  <!-- <input placeholder="何人前かを入力させます。セレクトボックスでやる。" type="text" name="serving" class="form-control" required value="{{ $recipe->serving ?? old('serving') }}"> -->
  <input type="text" name="ingredient" class="form-control" required value="{{ $recipe->ingredient ?? old('ingredient') }}">
</div>

<div class="md-form">
  <label>調味料</label>
  <input type="text" name="seasoning" class="form-control" required value="{{ $recipe->seasoning ?? old('seasoning') }}">
</div>
<div class="md-form">
  <label>Step1</label>
  <input type="text" name="step_content" class="form-control" value="{{ $recipe->step_content ?? old('step_content') }}">
</div>
<div class="md-form">
  <label>Step2</label>
  <input type="text" name="step_content2" class="form-control" value="{{ $recipe->step_content2 ?? old('step_content2') }}">
</div>
<div class="md-form">
  <label>Step3</label>
  <input type="text" name="step_content3" class="form-control" value="{{ $recipe->step_content3 ?? old('step_content3') }}">
</div>
<div class="md-form">
  <label>Step4</label>
  <input type="text" name="step_content4" class="form-control" value="{{ $recipe->step_content4 ?? old('step_content4') }}">
</div>
<div class="md-form">
  <label>Step5</label>
  <input type="text" name="step_content5" class="form-control" value="{{ $recipe->step_content5 ?? old('step_content5') }}">
</div>
<div class="md-form">
  <label>Step6</label>
  <input type="text" name="step_content6" class="form-control" value="{{ $recipe->step_content6 ?? old('step_content6') }}">
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


