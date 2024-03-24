<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\MessageGiverController; 
use App\Http\Controllers\Admin\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Auth::routes(['register' => false]);


 Route::group(['middleware' => ['auth', 'permission','verified']], function() {
    /**
     * Logout Routes
     */
    // Route::get('/logout', 'LogoutController@perform')->name('logout.perform');

    Route::group(['prefix' => 'admin'], function() {

       Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
    /**
     * User Routes
     */
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/store', [UsersController::class, 'store'])->name('users.store');
       // Route::get('/create', [UsersController::class, 'store'])->name('users.store');
        Route::get('/{user}/show', [UsersController::class, 'show'])->name('users.show');
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('users.edit');
       // Route::post('/{user}/update', [UsersController::class, 'update'])->name('users.update');
       Route::post('/update', [UsersController::class, 'update'])->name('users.update');
        //Route::get('/{user}/delete', [UsersController::class, 'destroy'])->name('users.destroy'); 
        Route::post('/delete', [UsersController::class, 'delete'])->name('users.delete'); 
    });

    Route::group(['prefix' => 'message_giver'], function() {
        Route::get('/', [MessageGiverController::class, 'index'])->name('message_giver.index');
        Route::get('/create', [MessageGiverController::class, 'create'])->name('message_giver.create');
        Route::post('/store', [MessageGiverController::class, 'store'])->name('message_giver.store');
    });

    Route::group(['prefix' => 'tasks'], function() {
        Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/details/{id}', [TaskController::class, 'show'])->name('tasks.show');
       
    });



    
    /**
     * User Routes
     */

    Route::group(['prefix' => 'roles'], function() {
    Route::get('/', [RolesController::class, 'index'])->name('roles.index');
    Route::get('/create', [RolesController::class, 'create'])->name('roles.create');
    Route::post('/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('/{roles}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::patch('/{roles}/update', [RolesController::class, 'update'])->name('roles.update');
    Route::post('/{roles}/delete', [RolesController::class, 'destroy'])->name('roles.destroy');     
    });


    Route::group(['prefix' => 'permissions'], function() {

        Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
        Route::get('/create', [PermissionsController::class, 'create'])->name('permissions.create');
        Route::post('/store', [PermissionsController::class, 'store'])->name('permissions.store');
        Route::get('/{permissions}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
        Route::patch('/{permissions}/update', [PermissionsController::class, 'update'])->name('permissions.update');
        Route::post('/{permissions}/delete', [PermissionsController::class, 'destroy'])->name('permissions.destroy');          
        });

});
 

 });


// Passport  
 
Route::get('/', function () {
    return view('welcome');
});
 



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
 


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

 require __DIR__.'/auth.php';
