<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateBlogPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|max:10000',
            'title' => 'required',
        ];


    }
    public function messages()
    {
        return [
            'title.required' => 'Je bent de titel vergeten in te vullen.',
            'message.required' => 'Je bent vergeten een tekst te schrijven.',
            'message.max' => 'Je hebt meer dan 10.000 tekens gebruikt in jouw bericht.',
        ];
    }
}
