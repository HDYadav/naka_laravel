<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmployerEditRegistrationRequest extends FormRequest
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
        $userId = $this->route('id'); // Assuming you are passing the user ID in the route 

        return [
            'email' => 'required|email|unique:users,email,' . $userId,
            'mobile' => 'required|unique:users,mobile,' . $userId
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email cannot be empty!',
            'email.unique' => 'This email is already in use.',
            'mobile.required' => 'Mobile number cannot be empty!',
            'mobile.unique' => 'This mobile number is already in use.'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        if ($errors->has('email')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors->first('email'),
                'data' => null
            ], 200));
        }

        if ($errors->has('mobile')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors->first('mobile'),
                'data' => null
            ], 200));
        }

        // If no specific field error found, throw generic error
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'data' => null
        ], 200));
    }
}

