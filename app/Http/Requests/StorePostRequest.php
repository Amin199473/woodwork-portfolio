<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            "seo_title" => "required|min:3",
            "body" => "required|min:30",
            "meta_description" => "required|min:3",
            "meta_keywords" => "required|min:3",
            "category_id"=>"required|numeric",
            "image" => "mimes:jpeg,jpg,png,gif",
        ];
    }
}
