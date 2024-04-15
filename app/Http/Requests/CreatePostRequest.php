<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }
}
