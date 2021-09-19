@csrf
<div class="md-form">
  <label>タイトル</label>
  <input type="text" name="recipe_title" class="form-control" required value="{{ old('recipe_title') }}">
</div>
<div class="form-group">
  <label></label>
  <textarea name="content" required class="form-control" rows="16" placeholder="本文を">{{ old('content') }}</textarea>
</div>

<div class="md-form">
  <p>材料:</p>
  
  <input value="数値を入力してください" type="text" name="serving" class="form-control" required value="{{ old('serving') }}">
  <input type="text" name="ingredient" class="form-control" required value="{{ old('ingredient') }}">
</div>
<div class="md-form">
  <label>調味料</label>
  <input type="text" name="seasoning" class="form-control" required value="{{ old('seasoning') }}">
</div>
<div class="md-form">
  <label>Step1</label>
  <input type="text" name="step_content" class="form-control" required value="{{ old('step_content') }}">
</div>
<div class="md-form">
  <label>Step2</label>
  <input type="text" name="step_content2" class="form-control" required value="{{ old('step_content2') }}">
</div>
<div class="md-form">
  <label>Step3</label>
  <input type="text" name="step_content3" class="form-control" required value="{{ old('step_content3') }}">
</div>
<div class="md-form">
  <label>Step4</label>
  <input type="text" name="step_content4" class="form-control" required value="{{ old('step_content4') }}">
</div>
<div class="md-form">
  <label>Step5</label>
  <input type="text" name="step_content5" class="form-control" required value="{{ old('step_content5') }}">
</div>
<div class="md-form">
  <label>Step6</label>
  <input type="text" name="step_content6" class="form-control" required value="{{ old('step_content6') }}">
</div>
<div class="md-form">
  <label>コツ・ポイント</label>
  <input type="text" name="cooking_point" class="form-control" required value="{{ old('cooking_point') }}">
</div>