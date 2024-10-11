<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ShoeManager;




Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


//Adicionar ->middleware('auth') impede acesso via url sem autenticação

Route::get('/addShoe', [ShoeManager::class, 'addShoe'])->middleware('auth')->name('addShoe');
Route::post('/addShoe', [ShoeManager::class, 'addShoePost'])->middleware('auth')->name('addShoe.post');


Route::get('/home', [ShoeManager::class, 'displayShoes'])->middleware('auth')->name('home');
Route::get('/search', [ShoeManager::class, 'search'])->middleware('auth')->name('search');




