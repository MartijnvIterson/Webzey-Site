<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePermRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('permission-aanmaken');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:25',
            'display_name' => 'required|max:25',
            'description' => 'required|max:1500',
        ];


    }
    public function messages()
    {
        return [
            'name.required' => 'Je hebt de permission naam niet ingevuld.',
            'name.max' => 'De permission naam is te lang.',
            'display_name.required' => 'Je hebt de permission display naam niet ingevuld.',
            'description.required' => 'Je hebt geen permission beschrijving toegevoegd.',
        ];
    }
}
