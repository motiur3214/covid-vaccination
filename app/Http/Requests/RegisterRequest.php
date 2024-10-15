<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    public function authorize(): true
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'nid' => ['required', 'string', 'max:12', 'unique:users'],
            'vaccination_center_id' => ['required', 'integer'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
