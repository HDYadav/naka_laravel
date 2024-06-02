<?php

use App\Http\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Vendor\VendorController;  
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Jobs\JobsCotroller;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::controller(App\Http\Controllers\Auth\AuthOtpController::class)->group(function(){   
//     Route::post('otp/generate', 'generate')->name('otp.generate');
//     Route::get('otp/verification/{user_id}', 'verification')->name('otp.verification');
//     Route::post('otp/login', 'loginWithOtp')->name('otp.getlogin');   
// });


//Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']); 


Route::group(['middleware' => ['cors', 'json.response']], function () { 
   
    Route::post('/login', [ApiAuthController::class, 'login'] )->name('login.api');

    Route::post('/admin_login', [ApiAuthController::class, 'admoinLogin'])->name('admin_login.api');

    Route::post('/user_register',[ApiAuthController::class, 'register'])->name('user_register.api'); 
    Route::post('/login_with_otp', [ApiAuthController::class, 'loginWithOtp'])->name('login_with_otp.api');
    Route::post('/resent_otp', [ApiAuthController::class, 'resendOtp'])->name('resent_otp.api');
    Route::post('/employer_register', [ApiAuthController::class, 'employerRegister'])->name('employer_register.api');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');  // forgot password 
    Route::post('/check_email', [ResetPasswordController::class, 'checEmail'])->name('check_email.api');

    //Route::post('/change-password',  [ResetPasswordController::class, 'changePassword'])->middleware('auth:api');



    Route::prefix('password')->group(function () {
        Route::post('/reset', [ResetPasswordController::class, 'reset'])->name('reset');
    });  
 

});
 

Route::group(['middleware' => 'auth:api'], function () { 
 
 Route::post('/change-password',  [PasswordController::class, 'changePassword']);


    Route::prefix('jobs')->group(function () {

        Route::get('/get_all', [JobsCotroller::class, 'getAll'])->name('get_all');

        Route::get('/get_city', [JobsCotroller::class, 'getCity'])->name('get_city');
        Route::post('/create_update', [JobsCotroller::class, 'jobCreateOrUpdate'])->name('create_update');
        Route::get('/get_jobs', [JobsCotroller::class, 'getAllJobs'])->name('get_jobs');

        Route::get('/get_jobs_details/{id}', [JobsCotroller::class, 'getAllJobsDetails'])->name('get_jobs_details');
        Route::get('/emp_filter', [JobsCotroller::class, 'empFilter'])->name('emp_filter');
        Route::post('/jobs_opening', [JobsCotroller::class, 'jobOpenings'])->name('jobs_opening');
        Route::post('/add_favourite', [JobsCotroller::class, 'addFavourite'])->name('add_favourite');
        Route::get('/get_favourite', [JobsCotroller::class, 'getFavourite'])->name('get_favourite');
        Route::get('/get_company', [JobsCotroller::class, 'getCompany'])->name('get_company');  

    });


    Route::post('/edu_create_update', [JobsCotroller::class, 'eduCreateOrUpdate'])->name('edu_create_update');
    Route::get('/get_educations', [JobsCotroller::class, 'getEducations'])->name('get_educations');
    Route::delete('/delete_edu/{id}', [JobsCotroller::class, 'deleteEducation'])->name('delete_edu');


    Route::post('/exp_create_update', [JobsCotroller::class, 'expCreateOrUpdate'])->name('exp_create_update');
     Route::get('/get_experiance', [JobsCotroller::class, 'getExp'])->name('get_experiance');
     Route::delete('/delete_exp/{id}', [JobsCotroller::class, 'deleteExp'])->name('delete_exp');


    Route::post('/social_create_update', [JobsCotroller::class, 'socialCreateOrUpdate'])->name('social_create_update');
    Route::get('/get_social', [JobsCotroller::class, 'getSocial'])->name('get_social');
    Route::delete('/delete_social/{id}', [JobsCotroller::class, 'deleteSocial'])->name('delete_social'); 


   
   Route::prefix('users')->group(function () {
    Route::post('/get_user', [UserController::class, 'getUserData'] )->name('get_user');
    Route::get('/get_all_users', [UserController::class, 'getAllUsers'])->name('get_all_users');
    Route::post('/upload_image', [UserController::class, 'uploadImage'])->name('upload_image');
    Route::post('/update_profile', [UserController::class, 'updateProfile'])->name('update_profile');
    Route::get('/get_employe_basic_details', [UserController::class, 'getEmployeBasicDetails'])->name('get_employe_basic_details');
    Route::post('/update_company_info', [UserController::class, 'updateCompanyInfo'])->name('update_company_info');
    Route::get('/get_company_info', [UserController::class, 'getCompanyInfo'])->name('get_company_info');
    Route::post('/update_company_founding', [UserController::class, 'updateFoundingInfo'])->name('update_company_founding');
    Route::get('/get_founding_info', [UserController::class, 'getFoundingInfo'])->name('get_founding_info');


     Route::get('/profile_status', [UserController::class, 'getProfileInfo'])->name('profile_status');







   });

    Route::delete('users/{id}/soft-delete', [UserController::class, 'softDelete']);
    Route::patch('users/{id}/restore', [UserController::class, 'restore']);

    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api'); 
});


