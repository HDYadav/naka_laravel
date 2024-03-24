<?php

namespace App\Repository;

use App\Contracts\UserRepositoryInterface;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Auth;
use App\Models\UserDetail;
use Illuminate\Support\Str;

class SignupRepository implements UserRepositoryInterface
{ 


    private static $role_id = 7;  // role id 7 is for memeber 
    
    public function create($request)
    {

        
        $user =  User::create([           
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

         

       // $user->assignRole([self::$role_id]); // assign the role of registerd user

        return $user;
    }



     
}
