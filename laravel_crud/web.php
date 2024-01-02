<?php

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cache Cleared";
});

Route::get('/', function () {
    return view('welcome');
});

// <!-- Registation off---->
    Auth::routes(['verify' => true, 'register' => false]);

 Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace'=>'Admin', 'middleware' => ['admin:admin,super-admin']], function () {
    //routes
});

Route::group(['middleware' => 'auth'], function () {

});