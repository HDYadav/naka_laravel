<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmployerRegistrationRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|unique:users,mobile'
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'Name can not be empty !',
            'mobile.required' => 'Mobile number can not be empty !'
        ];
    }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => $validator->errors()->all(),
    //         'data' => null
    //     ], 200));
    // }

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
