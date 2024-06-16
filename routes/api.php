<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Attributes\AttributesController;
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

        Route::prefix('attributes')->group(function () {
        Route::post('/position_add_update', [AttributesController::class, 'positionAddUpdate'])->name('position_add_update');
        Route::get('/get_job_position/{id}', [AttributesController::class, 'getJobPosition'])->name('get_job_position');

        Route::post('/emp_type_add_update', [AttributesController::class, 'empTypeAddUpdate'])->name('emp_type_add_update');
        Route::get('/emp_type/{id}', [AttributesController::class, 'getEmpType'])->name('emp_type');
        Route::post('/industry_type_add_update', [AttributesController::class, 'industryTypeAddUpdate'])->name('industry_type_add_update');
        Route::get('/industry_type/{id}', [AttributesController::class, 'getIndustryType'])->name('industry_type');
        Route::post('/skills_add_update', [AttributesController::class, 'skillsAddUpdate'])->name('skills_add_update');
        Route::get('/get_skills/{id}', [AttributesController::class, 'getSkills'])->name('get_skills');

        Route::post('/experiance_add_update', [AttributesController::class, 'experianceAddUpdate'])->name('experiance_add_update');
        Route::get('/get_experiance/{id}', [AttributesController::class, 'getExperiance'])->name('get_experiance');



        });


    Route::prefix('jobs')->group(function () {
        Route::get('/get_all', [JobsCotroller::class, 'getAll'])->name('get_all');
        Route::get('/get_city', [JobsCotroller::class, 'getCity'])->name('get_city');
        Route::post('/create_update', [JobsCotroller::class, 'jobCreateOrUpdate'])->name('create_update');
        Route::get('/get_jobs', [JobsCotroller::class, 'getAllJobs'])->name('get_jobs');
        Route::get('/get_jobs_details/{id}', [JobsCotroller::class, 'getAllJobsDetails'])->name('get_jobs_details');  // for employer company 
        Route::get('/get_employee_jobs_details/{id}', [JobsCotroller::class, 'getEmpJobsDetails'])->name('get_employee_jobs_details');  // for emploee job seekeer 
        Route::get('/emp_filter', [JobsCotroller::class, 'empFilter'])->name('emp_filter');
        Route::post('/jobs_opening', [JobsCotroller::class, 'jobOpenings'])->name('jobs_opening');
        Route::post('/add_favourite', [JobsCotroller::class, 'addFavourite'])->name('add_favourite');
        Route::get('/get_favourite', [JobsCotroller::class, 'getFavourite'])->name('get_favourite');
        Route::get('/get_company', [JobsCotroller::class, 'getCompany'])->name('get_company');
        Route::post('/apply_job', [JobsCotroller::class, 'applyJob'])->name('apply_job'); // applyed the job
        Route::get('/get_applyed_job', [JobsCotroller::class, 'getAppliedJob'])->name('get_applyed_job');
        Route::post('/add_emp_favourite', [JobsCotroller::class, 'addEmployerFavourite'])->name('add_emp_favourite');
        Route::get('/get_favorate_applyed_job', [JobsCotroller::class, 'getFavorateApplyedJob'])->name('get_favorate_applyed_job');
        Route::get('/get_recently_applyed_job', [JobsCotroller::class, 'getRecentlyAppliedJob'])->name('get_recently_applyed_job'); // for emloyer
        Route::post('/change_application_status', [JobsCotroller::class, 'jobApplicationStatus'])->name('change_application_status');
        Route::get('/get_job_applyed_list', [JobsCotroller::class, 'getJobAppliyedList'])->name('get_job_applyed_list'); // for employee
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
    Route::post('/get_applyed_job_on_status', [JobsCotroller::class, 'getJobAppliyedJobOnStatus'])->name('get_applyed_job_on_status'); // for employee


   
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
    Route::post('/get_user_profile', [UserController::class, 'getUserProfile'])->name('get_user_profile');
   });

    Route::delete('users/{id}/soft-delete', [UserController::class, 'softDelete']);
    Route::patch('users/{id}/restore', [UserController::class, 'restore']);

    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api'); 
});


