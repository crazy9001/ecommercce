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
            'title' => 'required|max:255',
            'slug' => 'required|max:255|unique:post',

        ];
        if (request()->isMethod('PATCH')) {
            $rules['slug'] = 'required|max:255|unique:post,slug,' . request()->id;
        };

        return $rules;
    }
}
