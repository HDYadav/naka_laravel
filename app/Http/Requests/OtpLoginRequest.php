<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OtpLoginRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'otp' => 'required',
        ];
    }

    public function messages()
    {
        return [
                'user_id.required' => 'User ID can not be empty !',
                'otp.required' => 'One time password can not be empty !',              
        ];
    }


    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        if ($errors->has('user_id')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors->first('user_id'),
                'data' => null
            ], 200));
        }

        if ($errors->has('otp')) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => $errors->first('otp'),
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


    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ], 201));

    // }


}
