<?php

namespace App\Repository;

use App\Contracts\UserRepositoryInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{

    public $superAdmin;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->superAdmin = '1';
    }

    public function create($request)
    {

        $user =  User::create([
            'parent_id' => $request->parent_id,
            'location_id' => $request->location_id,
            'user_name' => $request->mobile,
            'real_password' => Str::random(),
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'mobile' => $request->mobile,
            'status' => $request->status,
            'password' => Hash::make('12345678'),
        ]);
        return  $user->assignRole([$request->role_id]);
    }

    public function getUsers(Request $request)
    {
        $users = DB::table('users as u')
            ->join('model_has_roles as mhr', 'mhr.model_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'mhr.role_id')
            ->select('u.id', 'u.parent_id', 'u.name', 'u.mobile', 'r.name as role');

        if (Auth::user()->id != $this->superAdmin) {
            $users->where('u.parent_id', Auth::user()->id);
        }

        return $users->get();
    }


    public function getRoles()
    {

        //   $roles = Role::orderBy('id','ASC')->pluck('name', 'id'); 

        $roless = $this->getRoleByID();

        $roles = DB::table('roles')
            ->select('id', 'name');

        if ($roless['0']->name != $this->superAdmin) {
            $roles->where('id', '>', $roless['0']->id);
        }

        return $roles->get();
    }


    public function getRoleByID()
    {

        return DB::table('users as u')
            ->join('model_has_roles as mhr', 'mhr.model_id', '=', 'u.id')
            ->join('roles as r', 'r.id', '=', 'mhr.role_id')
            ->where('u.id', Auth::user()->id)
            ->select('r.id as id', 'r.name as name')->orderBy('r.id', 'ASC')->get()->toArray();
    }
 

 

    public function update($request){

       User::where('id', $request->id)
       ->update([
           'name' => $request->name,
           'parent_id' => $request->parent_id,
            'location_id' => $request->location_id,
           'user_name' => $request->mobile,
           'real_password' => Str::random(),           
           'email' => $request->email,
           'address' => $request->address,
           'mobile' => $request->mobile,
           'status' => $request->status,
           'password' => Hash::make('12345678'),
        ]); 

        $user =  User::findOrFail($request->id); 
        return $user->syncRoles([$request->role_id]); 

    }
 


}
