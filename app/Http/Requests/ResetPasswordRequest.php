<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'new-password-0' => 'bail|required|min:6',
            'new-password-1' => 'bail|same:new-password-0|required|min:6',
            'old-password-0' => 'bail|required',

        ];
    }
    public function messages()
    {
        return [
            'new-password-0.same' => 'De wachtwoorden komen niet overeen.',
            'new-password-0.required' => 'Je hebt geen nieuw wachtwoord ingevuld.',
            'new-password-0.min' => 'Het wachtwoord moet minimaal 6 characters lang zijn.',
            'new-password-1.required' => 'Je hebt geen nieuw wachtwoord ingevuld.',
            'new-password-1.min' => 'Het wachtwoord moet minimaal 6 characters lang zijn.',
            'old-password-0.required' => 'Je moet je oude wachtwoord invullen.',
        ];
    }
}
