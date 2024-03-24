<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class AccountRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'required|unique:accounts,code',    
            'type_id' => 'required',
            'parent_account_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
                'name.required' => 'Name can not be empty !',  
                'code.required' => 'Code can not be empty !',  
                'type_id.required' => 'Type can not be empty !',
                'parent_account_id.required' => 'Parent can not be empty !'                                
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
