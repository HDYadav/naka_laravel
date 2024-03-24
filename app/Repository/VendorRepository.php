<?php

namespace App\Repository; 

use App\Contracts\DataInsertionInterface;
use App\Models\Vendor; 
use App\Helpers\UserData;

class VendorRepository
{ 
    
    public function insertData($request)
    { 
        $user = UserData::getUserFrToken($request); 
        $vendors =  Vendor::create([           
                'name' => $request->name, 
                'type' => $request->type,
                'currency_id' => $request->currency_id,      
                'country_id' => $request->currency_id,
                'province_state' => $request->province_state,
                'created_by' => $user->id
        ]); 
 
        return $vendors;
    }



     
}
