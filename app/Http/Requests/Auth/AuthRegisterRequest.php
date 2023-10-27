<?php

namespace App\Http\Requests\Auth;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => ['required','unique:users','email'],
            'password' => ['required','confirmed',Password::min(8)->letters()->numbers()],
            'birth_day' => ['required', 'before:'.Carbon::now()->subYears(18)->format('Y-m-d')]
        ];
    }

    public function messages()
    {
        return [
            'birth_day.before' => 'You must be over 18 years old'
        ];
    }
}
