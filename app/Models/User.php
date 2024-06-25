<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;


class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes;

     protected $connection = 'mysql';
    // protected $connection = 'second_db';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     * 'skills' => $request->skills,
            'languages' => $request->languages,
            'profilePicture' => $profilePicture,
            'resume' =>
            $resume,
            'maritalStatus' => $request->maritalStatus,
            'gender' => $request->gender,


     */
    protected $fillable = [   
        'name',        
        'email',
        'mobile',
        'user_type',
        'otp_verified',
        'dob',
        'company_name',
        'company_size',
        'basicProfile',
        'companyInfo',
        'foundingInfo',
        'password',
        'experienced',
        'professionId',
        'educationId',
        'skills',
        'languages',
        'profilePic',
        'resume',
        'maritalStatus',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
 

   


}
