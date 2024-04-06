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
            'dob' => $request->date_of_birth,
            'user_type' => $request->user_type,
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password),
            
        ]);

         

       // $user->assignRole([self::$role_id]); // assign the role of registerd user

        return $user;
    }



    public function employerCreate($request)
    {
        $user =  User::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'company_size' => $request->company_size,
            'mobile' => $request->mobile,
            'email' => $request->email,          
            'user_type' => '2',
            'password' => Hash::make($request->password),
            'password_confirmation' => Hash::make($request->password),

        ]);



        // $user->assignRole([self::$role_id]); // assign the role of registerd user

        return $user;
    }




     
}
