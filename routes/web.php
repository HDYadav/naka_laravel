<?php

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
 


// Passport 

 

Route::get('/about_us', function () {
     
    return view('about_us');
});

Route::get('/contact_us', function () {

    return view('contact_us');
});

Route::get('/privacy_policy', function () {

    return view('privacy_policy');
});

Route::get('/terms_conditions', function () {

    return view('terms_conditions');
});








Route::post('/test', function () {
    return "Hello";
});



 
