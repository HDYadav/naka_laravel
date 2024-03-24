<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CustomerRequest extends FormRequest
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
            'customer' => 'required',
            'first_name' => 'required',                        
        ];
    }

    public function messages()
    {
        return [
                'customer.required' => 'Customer can not be empty !',  
                'first_name.required' => 'first Name can not be empty !'                                                
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      =>  $validator->getMessageBag()->toArray()
        ], 201));

    }
}
