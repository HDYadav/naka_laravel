<?php

namespace App\Repository; 

use App\Contracts\DataInsertionInterface;
use App\Models\Accounts; 
use App\Helpers\UserData; 
 

class AccountRepository implements DataInsertionInterface
{ 
    
    public function insertData($request)
    { 
        $user = UserData::getUserFrToken($request); 
        
        $accounts =  Accounts::create([           
                'name' => $request->name,
                'code' => $request->code,
                'type_id' => $request->type_id,           
                'parent_account_id' => $request->parent_account_id,
                'descriptions' => $request->descriptions,
                'created_by' => $user->id
        ]); 
 
        return $accounts;
    }



     
}
