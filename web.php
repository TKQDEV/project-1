<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');
Route::get('/verify-email', [EmailVerificationNotificationController::class, 'create'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');


require __DIR__.'/auth.php';

use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashsoard'])->name('admin.dashboard');
    Route::get('/products', [AdminController::class, 'indexProducts'])->name('admin.products.index');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::get('/orders', [AdminController::class, 'indexOrders'])->name('admin.orders.index');
    Route::get('/orders/{id}/edit', [AdminController::class, 'editOrder'])->name('admin.orders.edit');
    Route::put('/orders/{id}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
    Route::delete('/orders/{id}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');
    Route::get('/users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::get('/categories', [AdminController::class, 'indexCategories'])->name('admin.categories.index');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
    
    // Các route khác cho admin
});
use App\Http\Controllers\UserController;
Route::prefix('user')->middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'showProfile'])->name('user.profile');
    Route::get('/products', [UserController::class, 'indexProducts'])->name('user.products.index');
    Route::get('/products/{id}', [UserController::class, 'showProduct'])->name('user.products.show');
    Route::post('/products/{id}/add-to-cart', [UserController::class, 'addProductToCart'])->name('user.products.addToCart');
    Route::get('/products/cart', [UserController::class, 'showCart'])->name('user.cart.index');
    Route::post('/products/cart/remove/{productId}', [UserController::class, 'removeFromCart'])->name('user.cart.remove');
    Route::post('/products/cart/update/{productId}', [UserController::class, 'updateCart'])->name('user.cart.update');
    Route::post('/products/cart/checkout', [UserController::class, 'checkout'])->name('user.cart.checkout');
    Route::get('/orders', [UserController::class, 'indexOsder'])->name('user.orders.index');
    Route::get('/cart', [UserController::class, 'showCart'])->name('user.cart.index');

    
    // Các route khác cho user
});


