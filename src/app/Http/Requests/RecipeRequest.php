<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'recipe_title' => 'required|max:50',
          'content' => 'required|max:200',
          'ingredient' => 'required|max:200',
          'seasoning' => 'required|max:200',
          'step_content' => 'required|max:200',
          'step_content2' => 'required|max:200',
          'step_content3' => 'required|max:200',
          'step_content4' => 'required|max:200',
          'step_content5' => 'required|max:200',
          'step_content6' => 'required|max:200',
          'cooking_point' => 'required|max:200',
          
        ];
    }

    public function attributes()
    {
        return [
            'recipe_title' => 'レシピタイトル',
            'content' => '本文',
            'ingredient' => '材料：',
            'seasoning' => '調味料',
            'step_content' => 'Step1',
            'step_content2' => 'Step2',
            'step_content3' => 'Step3',
            'step_content4' => 'Step4',
            'step_content5' => 'Step5',
            'step_content6' => 'Step6',
            'cooking_point' => 'コツ・ポイント',
        ];
    }

}
