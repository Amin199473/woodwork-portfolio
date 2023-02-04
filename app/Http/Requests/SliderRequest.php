<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "title" => "required|min:3",
            "subtitle" => "required|min:3",
            "button" => "required|min:3",
            "link_button" => "required|min:3",
            "image" => "mimes:jpeg,jpg,png,gif",
        ];
    }
}
