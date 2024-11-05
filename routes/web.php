<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ShoeManager;
use App\Http\Controllers\UserManager;
use App\Http\Controllers\CartController;



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

// Adicionar ->middleware('auth') impede acesso via URL sem autenticação
Route::get('/user', [UserManager::class, 'userMenu'])->middleware('auth')->name('user');
Route::get('/user/{id}', [UserManager::class, 'showUser'])->name('user.show');
Route::put('/user/{id}', [UserManager::class, 'update'])->name('user.update');

// Rota para exibir os sapatos de um usuário específico
Route::get('/user/{id}/shoes', [UserManager::class, 'displayUserShoes'])->name('user.shoes');

Route::get('/users', [UserManager::class, 'usersMenu'])->middleware('auth')->name('users');

// Shoe
Route::get('/addShoe', [ShoeManager::class, 'addShoe'])->middleware('auth')->name('addShoe');
Route::post('/addShoe', [ShoeManager::class, 'addShoePost'])->middleware('auth')->name('addShoe.post');

Route::get('/home', [ShoeManager::class, 'displayShoes'])->middleware('auth')->name('home');
Route::get('/search', [ShoeManager::class, 'search'])->middleware('auth')->name('search');
Route::post('/favorites/add', [ShoeManager::class, 'addFavorite'])->middleware('auth')->name('favorites.add');
Route::get('/cheapest-shoe', [ShoeManager::class, 'CheapestShoeHighlight'])->name('cheapest.shoe.highlight');



Route::get('/shoe/{id}', [ShoeManager::class, 'show'])->name('viewShoe');
Route::post('/add-favorite', [ShoeManager::class, 'addFavorite'])->name('addFavorite');

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{shoeId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');


