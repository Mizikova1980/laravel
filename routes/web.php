<?php

use App\Http\Controllers\BasketController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
})->name('main');


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin')->middleware('is_admin');
Route::get('/enterAsUser/{userId}', [App\Http\Controllers\AdminController::class, 'enterAsUser'])->name('enterAsUser');
Route::get('/exportCategories', [App\Http\Controllers\AdminController::class, 'exportCategories'])->name('exportCategories');
Route::get('/exportProducts', [App\Http\Controllers\AdminController::class, 'exportProducts'])->name('exportProducts');
Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
Route::post('/exportCategories/update',[App\Http\Controllers\AdminController::class, 'createCategory'])->name('createCategory');
Route::post('/exportProducts/update',[App\Http\Controllers\AdminController::class, 'createProduct'])->name('createProduct');
Route::get('/enterAsUser/{userId}', [App\Http\Controllers\AdminController::class, 'enterAsUser'])->name('enterAsUser');
Route::post('/exportCategoriesJob', [App\Http\Controllers\AdminController::class, 'exportCategoriesJob'])->name('exportCategoriesJob');
Route::post('/exportProductsJob', [App\Http\Controllers\AdminController::class, 'exportProductsJob'])->name('exportProductsJob');
Route::get('/importCategoriesJob', [App\Http\Controllers\AdminController::class, 'importCategoriesJob'])->name('importCategoriesJob');
Route::get('/importProductsJob', [App\Http\Controllers\AdminController::class, 'importProductsJob'])->name('importProductsJob');
Route::post('/saveFileCategories',[App\Http\Controllers\AdminController::class, 'saveFileCategories'])->name('saveFileCategories');
Route::post('/saveFileProducts',[App\Http\Controllers\AdminController::class, 'saveFileProducts'])->name('saveFileProducts');


Route::get('/profile',[App\Http\Controllers\ProfileController::class, 'profile'])->name('profile')->middleware('auth');

Route::post('/profile/update',[App\Http\Controllers\ProfileController::class, 'profileUpdate'])->name('profileUpdate');



Route::get('/categories/{category}', [App\Http\Controllers\CategoriesController::class, 'category'])->name('categories');
Route::get('/categories/{category}/getProducts', [App\Http\Controllers\CategoriesController::class, 'getProducts'])->name('getProducts');


Route::get('/categories/products/{id}', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');

Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name ('orders');



Route::prefix('basket')->group(function () {
    Route::get('/', [App\Http\Controllers\BasketController::class, 'index'])->name('basket');
    Route::get('/getProductsQuantity', [App\Http\Controllers\BasketController::class, 'getProductsQuantity']);
    Route::post('/createOrder', [App\Http\Controllers\BasketController::class, 'createOrder'])->name('createOrder');
    Route::prefix('product')->group(function () {
        Route::post('/add', [App\Http\Controllers\BasketController::class, 'add'])->name('addProduct');
        Route::post('/remove', [App\Http\Controllers\BasketController::class, 'remove'])->name('removeProduct');
    });
});

