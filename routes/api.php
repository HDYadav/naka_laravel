<?php

use App\Http\Controllers\API\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Vendor\VendorController;  
use App\Http\Controllers\Customer\CustomerController;
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
   
    //Route::post('/login', [ApiAuthController::class, 'login'] )->name('login.api');
    Route::post('/register',[ApiAuthController::class, 'register'])->name('register.api'); 
    Route::post('/login_with_otp', [ApiAuthController::class, 'loginWithOtp'])->name('login_with_otp.api');
    Route::post('/employer_register', [ApiAuthController::class, 'employerRegister'])->name('employer_register.api');  
 

});
 

Route::group(['middleware' => 'auth:api'], function () {
  Route::post('/login', [ApiAuthController::class, 'login'])->name('login');
 
   Route::prefix('vendors')->group(function () {
    Route::post('/add', [VendorController::class, 'storeVendor'] )->name('add');
   }); 

  //  Route::prefix('customers')->group(function () {
  //   Route::post('/add', [CustomerController::class, 'storeCustomer'] )->name('add');
  //  });  
   
   Route::prefix('users')->group(function () {
    Route::post('/get_user', [UserController::class, 'getUserData'] )->name('get_user');
    Route::get('/get_all_users', [UserController::class, 'getAllUsers'])->name('get_all_users');

   });   

 

    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api'); 
});


