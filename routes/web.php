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

// Default routes
Route::get('/', function () {
    
    // Verify if is logged in
    if (Auth::check()) {
        return redirect('/home');
    } else {
        return view('welcome');
    }
});

// Auth routes (auto-generated)
Auth::routes();

/*
|--------------------------------------------------------------------------
| Custom Routes
|--------------------------------------------------------------------------
|
| Here is where you can register new created routes of application.
|
*/

// Admin Routes
Route::prefix('admin')->group(function() {
    
    Route::get('/users', ['as' => 'users.list', 'uses' => 'AdminController@listUsers']);

    Route::prefix('skills')->group(function() {
        
        Route::get('/', ['as' => 'skills.list', 'uses' => 'SkillsController@list']);
        Route::get('/new', ['as' => 'skills.new', 'uses' => 'SkillsController@new']);

        Route::post('/create', ['as' => 'skills.create', 'uses' => 'SkillsController@create']);
    });

});

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

// Message Routes
Route::prefix('chat')->group(function() {

    // Render chat view
    Route::get('/profile/{id}', 'ChatsController@index');

    // Fetch all messages
    Route::get('/messages/{id}', 'ChatsController@fetchMessages');

    // Send message
    Route::post('/messages', 'ChatsController@sendMessage');
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

// Setup language
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=> 'LanguageController@switchLang']);

// Users Routes
Route::prefix('user')->group(function() {
    Route::get('/setup', 'UserController@setupAccount');
    Route::post('/setup', 'UserController@updateAccount');
});
