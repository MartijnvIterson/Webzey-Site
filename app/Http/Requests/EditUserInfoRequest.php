<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('gebruiker-aanpassen');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user-email' => 'bail|required|email',
            'user-name' => 'bail|required|min:3',
            'user-id' => 'bail|required|min:1|max:1',
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
