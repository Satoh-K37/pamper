<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
          'name' => 'required|max:20',
          // 'password' => '' ,
          'self_introduction' => 'max:200',
          // 画像の最大サイズを10MBに設定
          'profile_image' => 'file|mimes:jpeg,png,jpg,gif|max:10240',
        ];
    }

    public function attributes()
    {
        return [
          'name' => 'ユーザー名',
          'self_introduction' => '自己紹介',
          'profile_image' => 'アイコン',
        ];
    }

}
