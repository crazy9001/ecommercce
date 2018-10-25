<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'slug' => 'required|max:255|unique:category',

        ];
        if (request()->isMethod('PATCH')) {
            $rules['slug'] = 'required|max:255|unique:category,slug,' . request()->id;
        };

        return $rules;
    }
}
