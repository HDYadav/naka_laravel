<?php

namespace App\Repository;  
 
use App\Models\ChartOfAccounts;
use App\Helpers\UserData; 

class ChartsOfAccountRepository 
{ 
    
    public function insertChartOfAccount($request)
    { 
        $user = UserData::getUserFrToken($request); 
        
        $accounts =  ChartOfAccounts::create([           
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'identification_no'  => "GFPO-".rand(2,50),
                'account_currency'  => $request->account_currency, 
                'customer_id'  => $request->customer_id, 
                'industry_id'  => $request->industry_id, 
                'descriptions'  => $request->descriptions, 
                'created_by' => $user->id
        ]); 
 
        return $accounts;
    } 


    public function updateChartOfAccount($request)
    {     
        $user = UserData::getUserFrToken($request); 
        $accounts = ChartOfAccounts::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'identification_no' => "GFPO-" . rand(2, 50),
            'account_currency' => $request->account_currency,
            'customer_id'  => $request->customer_id, 
            'industry_id'  => $request->industry_id, 
            'descriptions' => $request->descriptions,
            'updated_by' => $user->id
        ]);
 
        return $accounts;
    } 


     
}
