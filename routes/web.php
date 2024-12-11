<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ShoeManager;
use App\Http\Controllers\UserManager;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\PostController;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\OrderController;


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
Route::get('/users/search', [UserController::class, 'search'])->middleware('auth')->name('searchUsers');

// Rotas relacionadas a tênis
Route::get('/addShoe', [ShoeManager::class, 'addShoe'])->middleware('auth')->name('addShoe');
Route::post('/addShoe', [ShoeManager::class, 'addShoePost'])->middleware('auth')->name('addShoe.post');

// Rota para exibir todos os tênis
Route::get('/home', [ShoeManager::class, 'displayShoes'])->middleware('auth')->name('home');
Route::get('/search', [ShoeManager::class, 'search'])->middleware('auth')->name('search');

// Adicionar aos favoritos
Route::post('/favorites/add', [ShoeManager::class, 'addFavorite'])->middleware('auth')->name('favorites.add');

// Exibir o tênis mais barato
Route::get('/cheapest-shoe', [ShoeManager::class, 'CheapestShoeHighlight'])->name('cheapest.shoe.highlight');

// Exibir um tênis específico
Route::get('/shoe/{id}', [ShoeManager::class, 'show'])->name('viewShoe');

// Rota para editar tênis
Route::get('/shoe/edit/{id}', [ShoeManager::class, 'edit'])->name('shoe.edit');
Route::put('/shoe/update/{id}', [ShoeManager::class, 'update'])->name('shoe.update');

Route::get('/shoes/{id}', [ShoeManager::class, 'view'])->name('shoes.view');

// Rota para adicionar aos favoritos
Route::post('/add-favorite', [ShoeManager::class, 'addFavorite'])->name('addFavorite');

// Rotas do carrinho de compras
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{shoeId}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
Route::get('/cart/ordered', [OrderController::class, 'ordered'])->name('cart.ordered');

// Rotas relacionadas aos posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/following', [PostController::class, 'following'])->name('posts.following');
Route::get('/posts/my-posts', [PostController::class, 'myPosts'])->name('posts.myPosts');
Route::get('/posts/brands', [PostController::class, 'filterByBrand'])->name('posts.filterByBrand');
Route::get('/posts/filterByBrand', [PostController::class, 'filterByBrand'])->name('posts.filterByBrand');

// Rota para exibir o post e seus comentários
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Rota para adicionar um comentário
Route::post('/posts/{post}/comment', [PostController::class, 'storeComment'])->name('posts.comment.store');

// Rota para excluir um comentário
Route::delete('/posts/{post}', [PostController::class, 'delete'])->name('posts.delete');

Route::get('shoes/{id}', [ShoeManager::class, 'show'])->name('shoe.show');

Route::get('shoes/{id}', [ShoeManager::class, 'show'])->name('shoe.show');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');