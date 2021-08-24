<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            'nazwa' => 'required|string|min:3|max:15|',
            'description' => 'max:300',
            'image' => 'required|mimes:jpg|max:15360‬',
            'hashtag1' => 'max:8',
            'hashtag2' => 'max:8',
            'hashtag3' => 'max:8',
        ];
    }
}
