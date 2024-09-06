<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('index');
});

Route::get('registration', function () {
    return view('registration');
})->name('registration');


Route::get('register', [RegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegistrationController::class, 'register'])->name('register.submit');

