<?php

namespace App\Http\Requests;
use App\Models\Url;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StoreUrlPostRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $rules['destination'] = 'required|url';                   

        return $rules;
    }

    public function messages()
    {
        return [
          'destination.required' => 'The destination url field is required.',          
          'destination.url' => 'The destination url format is invalid.',
        ];
             
    }
}
