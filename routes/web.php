<?php

use App\Http\Controllers\SiteController;
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

Route::get('/',[SiteController::class,'sitepage'])->name('site');
Auth::routes(['verify' => true]);
Route::get('/setlag/{lang}',[SiteController::class,'setlang'])->name('defultLang');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//gooogle login
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');
Route::get('/cart',[SiteController::class,'cart'])->name('cart');
