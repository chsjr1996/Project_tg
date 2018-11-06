<?php

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
    
    // Verify if is logged in
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('welcome');
    }
});

Auth::routes();

// Home Routes
Route::prefix('home')->group(function(){

    Route::get(
        '/',
        [
            'middleware' => 'auth',
            'uses'       => 'HomeController@index'
        ]
    );
});

// Profile Routes
Route::prefix('profile')->group(function() {

    // 
    Route::get('/{id?}', 'ProfileController@viewProfile');

    // Sections
    Route::get('loadSections/{id?}', 'ProfileController@loadSections');
    Route::put('update/section','ProfileController@updateSection');

    // Search
    Route::get('search/{query}', 'ProfileController@search');

    // Profile results
    Route::get('results/{query}', 'ProfileController@grid');
    Route::get('loadResults/{query}/{grid?}', 'ProfileController@search');

});

// Users Routes
Route::get('user/setup', 'UserController@setupAccount');
Route::post('user/setup', 'UserController@updateAccount');

// Admin Routes
Route::get('admin/users', 'AdminController@index');

// Settings

// Setup language
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
