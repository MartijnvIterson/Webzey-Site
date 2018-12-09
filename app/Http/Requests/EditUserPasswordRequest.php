<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditUserPasswordRequest extends FormRequest
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
            'user-password' => 'bail|required|min:6',
            'user-id' => 'bail|required|min:1|max:1',
        ];
    }
    public function messages()
    {
        return [
            'user-password.required' => 'Je hebt geen nieuw wachtwoord ingevuld.',
            'user-password.min' => 'Het wachtwoord moet minimaal 6 characters lang zijn.',
            'user-id.required' => '',
            'user-id.min' => '',
            'user-id.max' => '',
        ];
    }
}
