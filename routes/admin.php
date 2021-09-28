<?php

use App\Models\admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

define("PAGINATION", 10);
Route::group(['namespace' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/','dashboordController@index')->name('admin.dashboard');
    Route::get('/logout', 'loginController@logout')->name('admin.logout');
    Route::get('/profile', 'loginController@profile')->name('admin.profile');

    Route::group(['prefix' => 'language'], function () {
        ########################langeses begen###########################
        Route::get('/', 'languageController@index')->name('admin.language');
        Route::get('/create', 'languageController@create')->name('admin.language.create');
        Route::post('/store', 'languageController@store')->name('admin.language.store');
        Route::get('/delete/{id}', 'languageController@destroy')->name('admin.language.delete');
        Route::get('/edit/{id}', 'languageController@edit')->name('admin.language.edit');
        Route::post('/update/{id}', 'languageController@update')->name('admin.language.update');
    });
    ###############################end of langes rout########################
    ######################## main category begen###########################
    Route::group(['prefix' => 'maincategories'], function () {
        Route::get('/', 'maincategoriesController@index')->name('admin.main_categories');
        Route::get('/create', 'maincategoriesController@create')->name('admin.main_categories.create');
        Route::post('/store', 'maincategoriesController@store')->name('admin.main_categories.store');
        Route::get('/delete/{id}', 'maincategoriesController@destroy')->name('admin.main_categories.delete');
        Route::get('/edit/{id}', 'maincategoriesController@edit')->name('admin.main_categories.edit');
        Route::post('/update/{id}', 'maincategoriesController@update')->name('admin.main_categories.update');
        Route::get('/statue/{id}', 'maincategoriesController@changestatue')->name('admin.main_categories.statue');

        ############################### maincategory of langes rout########################
    });

###########################end main categories#######################
 ######################## sub category begen###########################
 Route::group(['prefix' => 'subcategories'], function () {
    Route::get('/', 'subcategoriesController@index')->name('admin.sub_categories');
    Route::get('/create', 'subcategoriesController@create')->name('admin.sub_categories.create');
    Route::post('/store', 'subcategoriesController@store')->name('admin.sub_categories.store');
    Route::get('/{id}', 'subcategoriesController@show')->name('admin.sub_categories.show');
    Route::get('/delete/{id}', 'subcategoriesController@destroy')->name('admin.sub_categories.delete');
    Route::get('/edit/{id}', 'subcategoriesController@edit')->name('admin.sub_categories.edit');
    Route::post('/update/{id}', 'subcategoriesController@update')->name('admin.sub_categories.update');
    Route::get('/statue/{id}', 'subcategoriesController@changestatue')->name('admin.sub_categories.statue');

});

###########################end sub categories#######################




##########################began vendors ###########################
Route::group(['prefix' => 'vendors'], function () {
    Route::get('/', 'VendorsController@index')->name('admin.vendors');
    Route::get('/create', 'VendorsController@create')->name('admin.vendors.create');
    Route::post('/store', 'VendorsController@store')->name('admin.vendors.store');
    Route::get('/delete/{id}', 'VendorsController@destroy')->name('admin.vendors.delete');
    Route::get('/edit/{id}', 'VendorsController@edit')->name('admin.vendors.edit');
    Route::post('/update/{id}', 'VendorsController@update')->name('admin.vendors.update');
    Route::get('/statue/{id}', 'VendorsController@changestatue')->name('admin.vendors.statue');
    ############################### maincategory of langes rout########################
});
});


#######################end vendors###############################

######################## Brands begin ###################################

Route::resource('brands', 'BrandsController');
####################### Brands End ######################################
Route::group(["namespace" => "admin", 'middleware' => 'guest'], function () {
    Route::get('/login', 'loginController@index');
    Route::post('/login', 'loginController@getlogin')->name('admin.login');
});
