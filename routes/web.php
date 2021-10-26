<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::middleware('lang')->group(function () {
    Route::get('/',[SiteController::class,'sitepage'])->name('site');
    Route::get('/setlag/{lang}',[SiteController::class,'setlang'])->name('defultLang');
    Route::get('/category/{category}',[SiteController::class,'categorypage'])->name('category');
    Route::get('/product/{product}',[SiteController::class,'productpage'])->name('product');
    Route::get('/cart',[CartController::class,'index'])->name('cart');
    Route::get('add-to-cart/{id}',[CartController::class,'addToCart'])->name('add.to.cart');
    Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::delete('remove-from-cart', [CartController::class,'destroy'])->name('remove.from.cart');

    Route::middleware('auth')->group(function () {
      //wishlist
    Route::resource('/wishlist','WishlistController');
    Route::delete('/wishlist/deleteproduct/{wishlist}',[WishlistController::class,'deleteProduct'])->name('deleteproduct');
    Route::post('/wishlist/addproduct/{product}',[WishlistController::class,'addProduct'])->name('addproduct');
    Route::post('/wishlist/addtonew/{product}',[WishlistController::class,'addwithoutwishlist'])->name('addtonew');
    Route::get('/add-Allto-cart',[CartController::class,'addAlltoCart'])->name('add.allto.cart');

    });

    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
});


//gooogle login
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Auth::routes(['verify' => true]);
