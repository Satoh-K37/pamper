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
  <select class="form-control" name="serving">
    @foreach ($servings as $serving => $serving_name)
          <!-- <option value="{{ $serving }}"> -->
      <option value="{{ $serving }}" {{ old('serving_name', $recipe->serving ?? '') == $serving ? 'selected' : ''}}>
          {{ $serving_name }}
      </option>
    @endforeach
  </select>
</div>


<div class="card-body pt-0 pb-2 pl-3">
      <!-- <p class="desc text-left fs14" >画像ファイルを1点アップロードしてください<span class="required-text" color="red">※必須</span></p>
    <div class="md-form">
      <div class="form-group-sm">
        <!-- <input type="file" name="image_path"> -->
        <!-- {!! Form::label('image','画像', ['class' => 'd-block mt-2 mb-0']) !!} -->
        <!-- <input type="file" name="image_path" value="" class="ml-3 mr-2 d-inline"> -->
        <!-- <file-upload></file-upload>> -->
      <!-- </div>
    </div> -->
  <div class="md-form">
    <p class="desc text-left fs14" >画像ファイルを1点アップロードしてください<span class="required-text" color="red">※必須</span></p>
      <input type="file" name="image" value="" class="ml-3 mr-2 d-inline">
    @if(isset($recipe))
      @if(file_exists(public_path().'/storage/image_path/'. $recipe->id .'.jpg'))
          <img src="/storage/image_path/{{ $recipe->id }}.jpg">
      @elseif(file_exists(public_path().'/storage/image_path/'. $recipe->id .'.jpeg'))
          <img src="/storage/image_path/{{ $recipe->id }}.jpeg">
      @elseif(file_exists(public_path().'/storage/image_path/'. $recipe->id .'.png'))
          <img src="/storage/image_path/{{ $recipe->id }}.png">
      @elseif(file_exists(public_path().'/storage/image_path/'. $recipe->id .'.gif'))
          <img src="/storage/image_path/{{ $recipe->id }}.gif">
      @endif
    @endif
  </div>
</div>



<div class="md-form">
  <label>材料</label>
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


