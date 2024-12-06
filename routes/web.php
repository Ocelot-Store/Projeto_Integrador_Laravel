<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ShoeManager;
use App\Http\Controllers\UserManager;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController; // Importa o UserController para as rotas relacionadas a usuários
use App\Http\Controllers\PostController;

// Rota principal
Route::get('/', function () {
    return view('index');
});

// Rota para a página inicial
Route::get('/index', function () {
    return view('index');
})->name('index');

// Rotas de registro e autenticação
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

// Rotas relacionadas ao perfil de usuário
Route::get('/user', [UserManager::class, 'userMenu'])->middleware('auth')->name('user');
Route::get('/user/{id}', [UserManager::class, 'showUser'])->name('user.show');
Route::put('/user/{id}', [UserManager::class, 'update'])->name('user.update');
Route::get('/user/{id}/shoes', [UserManager::class, 'displayUserShoes'])->name('user.shoes');
Route::post('/user/update-profile-picture', [UserManager::class, 'updateProfilePicture'])->middleware('auth')->name('user.updateProfilePicture');
Route::post('/user/update-profile-cover', [UserManager::class, 'updateProfileCover'])->middleware('auth')->name('user.updateProfileCover');


// Rotas relacionadas à listagem de todos os usuários
Route::get('/users', [UserController::class, 'index'])->middleware('auth')->name('users');
Route::middleware('auth')->group(function () {
    Route::post('/user/{user}/follow', [UserManager::class, 'follow'])->name('user.follow');
    Route::post('/user/{user}/unfollow', [UserManager::class, 'unfollow'])->name('user.unfollow');
});

// Rotas relacionadas a tenis
Route::get('/addShoe', [ShoeManager::class, 'addShoe'])->middleware('auth')->name('addShoe');
Route::post('/addShoe', [ShoeManager::class, 'addShoePost'])->middleware('auth')->name('addShoe.post');

Route::get('/home', [ShoeManager::class, 'displayShoes'])->middleware('auth')->name('home');
Route::get('/search', [ShoeManager::class, 'search'])->middleware('auth')->name('search');
Route::post('/favorites/add', [ShoeManager::class, 'addFavorite'])->middleware('auth')->name('favorites.add');
Route::get('/cheapest-shoe', [ShoeManager::class, 'CheapestShoeHighlight'])->name('cheapest.shoe.highlight');

// Exibir um tenis específico e adicionar aos favoritos
Route::get('/shoe/{id}', [ShoeManager::class, 'show'])->name('viewShoe');
Route::post('/add-favorite', [ShoeManager::class, 'addFavorite'])->name('addFavorite');

// Rotas do carrinho de compras
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{shoeId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');

//Rotas do calculo do frete
Route::get('/calculadora-frete', function () {
    return view('calculadora-frete');
})->name('calculadora-frete');

Route::post('/calcular-frete', [CartController::class, 'calcularFrete'])->name('calcular-frete');


// Rotas relacionadas aos posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // Exibir posts
Route::post('/posts', [PostController::class, 'store'])->name('posts.store'); // Criar post
Route::get('/posts/following', [PostController::class, 'following'])->name('posts.following');// Exibir os posts dos usuários que o usuário autenticado está seguindo
Route::get('/posts/my-posts', [PostController::class, 'myPosts'])->name('posts.myPosts'); //Exibir posts do usuário autenticado



// Rota para exibir o post e seus comentários
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
// Rota para adicionar um comentário
Route::post('/posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment.store');

