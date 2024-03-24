<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
 

class ChartsOfAccountEditRequest extends FormRequest
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
            'parent_id' => 'required' 
        ];
    }

    public function messages()
    {
        return [  
                'name.required' => 'Name can not be empty !',  
                'parent_id.required' => 'Code can not be empty !'                                                
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
