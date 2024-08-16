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


Route::get('/', function () {

    return view('about_us');
});


Route::get('/About_Us.html', function () {
     
    return view('about_us');
});

Route::get('/Contact_Us.html', function () {

    return view('contact_us');
});

Route::get('/Privacy_Policy.html', function () {

    return view('privacy_policy');
});

Route::get('/Terms_Conditions.html', function () {

    return view('terms_conditions');
});








Route::post('/test', function () {
    return "Hello";
});



 
