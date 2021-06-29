<?php

namespace App\Http\Requests\Posts;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Post::getUpdateValidationRules();
        $rules['title'] = $rules['title'].$this->post->id;
        return $rules;
    }
}
