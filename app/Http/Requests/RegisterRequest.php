<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => [
                'required',
                'email', // Check if the input is in a valid email format
                Rule::unique('users', 'email'), // Check if the email is unique in the 'users' table
            ],
            'password' => 'required|min:6',
        ];
    }
}
