<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return "Migrations run successfully!";
});
