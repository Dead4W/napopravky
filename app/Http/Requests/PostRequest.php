<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'text' => 'required|string',
            'author' => 'required|string',
            'tags' => [
                'required',
                'array',
                'max:3',
            ],
            'tags.*' => "required|integer|min:0",
        ];

    }
}
