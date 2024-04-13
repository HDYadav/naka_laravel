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
            'dob' => $request->date_of_birth,
            'user_type' => 1,
            'password' => Hash::make($request->password) 
        ]);
        $user->makeHidden(['updated_at', 'created_at']);

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
            'password' => Hash::make($request->password) 

        ]);

        $user->makeHidden(['updated_at', 'created_at']);

        return $user;
 
    }




     
}
