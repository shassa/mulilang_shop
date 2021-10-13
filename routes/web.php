<?php

use App\Http\Controllers\SiteController;
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

Route::get('/', function () {
    return view('layouts.site');
});
Route::get('/site',[SiteController::class,'sitepage']);
Auth::routes();
Route::get('/setlag/{lang}',[SiteController::class,'defultLang'])->name('defultLang');
Route::get('/home', 'HomeController@index')->name('home');
