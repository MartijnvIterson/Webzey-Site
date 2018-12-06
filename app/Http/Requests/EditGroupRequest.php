<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('groep-aanpassen');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'color' => 'required|max:7',
            'name' => 'required|max:25',
        ];


    }
    public function messages()
    {
        return [
            'name.required' => 'Je hebt de permission naam niet ingevuld.',
            'name.max' => 'De permission naam is te lang.',
        ];
    }
}
