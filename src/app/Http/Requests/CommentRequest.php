<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        # 認証の仕組みがない場合は何でも通すという意味でtrueを設定
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
          'comment' => 'required|max:150',
        ];
    }

    /**
     * エラーメッセージを日本語化
     * 
     */
    public function messages()
    {
        return [
            // 'text.required' => 'コメント本文を入力してください',
            // 'text.max' => 'コメント本文は150文字以内で入力してください',
        ];
    }

}
