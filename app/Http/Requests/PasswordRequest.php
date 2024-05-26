<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class PasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = auth()->user();
                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('Old password is incorrect.');
                    }
                },
            ],
            'password' => 'required', // Additional rules like min length and confirmation
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password is required.',           
            'current_password.required' => 'Current password is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $errors->first(),
        ], 200));
    }
}
