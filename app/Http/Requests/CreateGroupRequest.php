<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateGroupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->can('groep-aanmaken');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:15',
            'display_name' => 'required',
            'description' => 'required',
            'color' => 'required',
        ];


    }
    public function messages()
    {
        return [
            'name.required' => 'Je hebt de groep naam niet ingevuld.',
            'name.max' => 'De groep naam is te lang.',
            'display_name.required' => 'Je hebt de groep display naam niet ingevuld.',
            'description.required' => 'Je hebt geen groep beschrijving toegevoegd.',
            'color.required' => 'Je hebt geen groep beschrijving toegevoegd.',
        ];
    }
}
