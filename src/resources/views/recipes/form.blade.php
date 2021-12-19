
<!-- 非表示の項目を開くときに使ってるアイコン -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@csrf
<div class='md-form'>
  <label>レシピタイトル<span> 必須</span></label>
    
  <input type="text" maxlength="50" name="recipe_title" class="form-control" required value="{{ $recipe->recipe_title ?? old('recipe_title') }}">
  <!-- v-model.trim="recipeTitleCount" -->
  <!-- <p class="text-right">@{{ recipeTitleCount.length }}/50</p> -->
</div>

<div class="form-group">
  <label></label>
    <textarea name="content" maxlength="300" class="form-control" rows="10" placeholder="ご褒美ご飯は何にした？">{{ $recipe->content ?? old('content') }}</textarea>
    <!-- v-model.trim="recipeContentCount" -->
    <!-- <p class="text-right">@{{ recipeContentCount.length }}/300</p> -->
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
        <span class="form-input__image_path--text">画像が登録されていません。画像は必須です。</span>
      </div>
    @endif
  </div>
</div>
  
@if(Route::is('recipes.edit'))
  <div class="form-group">
    <div class="card-text">
      <image-edit-preview></image-edit-preview>
    </div>
  </div>
@else
  <div class="form-group">
    <div class="card-text">
      <image-preview></image-preview>
    </div>
  </div>
@endif

<div class="hidden_box">
  <input type="checkbox" id="label1"/>
  <label for="label1" >材料、調味料</label>
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
    <textarea maxlength="200" name="ingredient" class="form-control"  placeholder="材料">{{ $recipe->ingredient ?? old('ingredient') }}</textarea>
    <!-- v-model.trim="recipeIngredientCount" -->
    <!-- <p class="text-right">@{{ recipeIngredientCount.length }}/200</p> -->
    <textarea maxlength="200" name="seasoning" class="form-control" placeholder="調味料">{{ $recipe->seasoning ?? old('seasoning') }}</textarea>
    <!-- v-model.trim="recipeSeasoningCount"  -->
    <!-- <p class="text-right">@{{ recipeSeasoningCount.length }}/200</p> -->
    <!--ここまで-->
  </div>
</div>


  <div class="hidden_box">
    <input type="checkbox" id="label2"/>
    <label for="label2">調理手順</label>
    <div class="hidden_show">

      <div class="md-outline">
        <textarea maxlength="100" placeholder="Step1" rows="3" name="step_content" class="form-control">{{ $recipe->step_content ?? old('step_content') }}</textarea>
        <!-- v-model.trim="recipeStep1Count" -->
        <!-- <p class="text-right">@{{ recipeStep1Count.length }}/100</p> -->
      </div>

      <div class="mform-outline">
        <textarea maxlength="100" placeholder="Step2" rows="3" name="step_content2" class="form-control">{{ $recipe->step_content2 ?? old('step_content2') }} </textarea>
        <!-- <p class="text-right">@{{ recipeStep2Count.length }}/100</p> -->
      </div>

      <div class="md-outline">
        <textarea maxlength="100" placeholder="Step3" rows="3" name="step_content3" class="form-control">{{ $recipe->step_content3 ?? old('step_content3') }}</textarea>
        <!-- v-model.trim="recipeStep3Count" -->
        <!-- <p class="text-right">@{{ recipeStep3Count.length }}/100</p> -->
      </div>

      <div class="md-outline">
        <textarea maxlength="100" placeholder="Step4" rows="3" name="step_content4" class="form-control">{{ $recipe->step_content4 ?? old('step_content4') }}</textarea>
        <!-- v-model.trim="recipeStep4Count" -->
        <!-- <p class="text-right">@{{ recipeStep4Count.length }}/100</p> -->
      </div>

      <div class="md-outline">
        <textarea maxlength="100" placeholder="Step5" rows="3" name="step_content5" class="form-control">{{ $recipe->step_content5 ?? old('step_content5') }}</textarea>
        <!-- v-model.trim="recipeStep5Count" -->
        <!-- <p class="text-right">@{{ recipeStep5Count.length }}/100</p> -->
      </div>

      <div class="md-outline">
        <textarea  maxlength="100" placeholder="Step6" rows="3" name="step_content6" class="form-control">{{ $recipe->step_content6 ?? old('step_content6') }}</textarea>
        <!-- v-model.trim="recipeStep6Count" -->
        <!-- <p class="text-right">@{{ recipeStep6Count.length }}/100</p> -->
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
  <label for="category_id">カテゴリ</label>
  <span>必須</span>
  <select class="form-control" name="category_id" required>
    
    @foreach ($categories as $id => $name)
      <option value="{{ $id }}" {{ old('category', $old_category_id->id ?? '') == $id ? 'selected' : ''}}>
          {{ $name }}
      </option>
    @endforeach
  </select>
</div>


