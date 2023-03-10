<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            "category_id"=>"required|numeric",
            "name"=>"required|min:3",
            "material"=>"required|min:3",
            "short_description"=>"required|min:10",
            "description"=>"required|min:10",
            'files' => 'mimes:jpeg,jpg,png,gif|size:1024',
        ];
    }
}
