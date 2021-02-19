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
        $rules = [
            'text' => 'required|string|min:1|max:255',
            'author' => 'required|string|min:1|max:32',
            'tags' => [
                'array',
                'min:1',
                'max:3',
            ],
            'tags.*' => "integer|min:0",
        ];

        switch ($this->getMethod()) {
            case 'POST':
                $_REQUEST = $_POST = [];

                return $rules;
            case 'GET':
                return [
                    "page" => "integer|min:1"
                ];
        }

        return [];

    }
}
