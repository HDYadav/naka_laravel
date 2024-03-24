<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\Chart\ChartOfAccountController;   
use App\Http\Controllers\Chart\AccountController;
use App\Http\Controllers\Client\ClientController;
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
 

// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']); 


Route::group(['middleware' => ['cors', 'json.response']], function () { 
   
    Route::post('/login', [ApiAuthController::class, 'login'] )->name('login.api');
    Route::post('/register',[ApiAuthController::class, 'register'])->name('register.api'); 
});
 

Route::group(['middleware' => 'auth:api'], function () { 

    Route::prefix('charts_of_accounts')->group(function () {
        Route::get('/', [ChartOfAccountController::class, 'index'])->name('charts_of_accounts.index');
        Route::get('/customer/{id}', [ChartOfAccountController::class, 'customerByID'])->name('charts_of_accounts.customer'); // import the data customer wise
        Route::get('/industry/{id}', [ChartOfAccountController::class, 'industryByID'])->name('charts_of_accounts.industry'); // import the data customer wise

        Route::get('/{id}', [ChartOfAccountController::class, 'show'])->name('charts_of_accounts.show'); 
        Route::post('/add', [ChartOfAccountController::class, 'storeChartsAccount'] )->name('add');
        Route::post('/edit/{id}', [ChartOfAccountController::class, 'updateChartsAccount'] )->name('edit');
    });  

   Route::prefix('accounts')->group(function () {
    Route::post('/add', [AccountController::class, 'storeAccount'] )->name('add');
   }); 

   Route::prefix('vendors')->group(function () {
    Route::post('/add', [VendorController::class, 'storeVendor'] )->name('add');
   }); 

   Route::prefix('customers')->group(function () {
    Route::post('/add', [CustomerController::class, 'storeCustomer'] )->name('add');
   });  
   
   Route::prefix('users')->group(function () {
    Route::post('/get_user', [UserController::class, 'getUserData'] )->name('get_user');
    Route::post('/get_all_users', [UserController::class, 'getAllUsers'])->name('get_all_users');

   });   

   Route::prefix('timesheets')->group(function () {
    
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'] );
    }); 

    });  


    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api'); 
});


