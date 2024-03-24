<?php

namespace App\Repository; 

use App\Models\Customer; 
use App\Helpers\UserData; 


class CustomerRepository
{ 
    
    public function insertData($request)
    { 

        $user = UserData::getUserFrToken($request);  

        $customer =  Customer::create([           
                'customer' => $request->customer, 
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,      
                'email' => $request->email,
                'phone_no' => $request->phone_no,
                'created_by' => $user->id
        ]); 
 
        return $customer;
    }



     
}
