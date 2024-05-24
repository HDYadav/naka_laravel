<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Old password is incorrect.');
                    }
                },
            ],
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Password is required.',          
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        if ($errors->has('password')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors->first('password') 
            ], 200));
        }

        if ($errors->has('current_password')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors->first('current_password') 
            ], 200));
        }

        // If no specific field error found, throw generic error
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed' 
        ], 200));
    }



    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success' => false,
    //         'message' => $validator->errors()->first(),
    //         'data' => null
    //     ], 200));
    // }
}
