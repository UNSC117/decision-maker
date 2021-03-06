<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/**
 * to avoid conflicts with angularJs
 */
Blade::setContentTags('<%', '%>');        // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');   // for escaped data

/**
 * Page flow setting
 */
Route::get('/', 'WelcomeController@index');

Route::controllers([
    'auth'     => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::get('/categories', 'PagesController@index');
Route::get('/items', 'PagesController@showItems');

/**
 *  Api flow setting
 */
Route::group(array('prefix' => 'api'), function(){
   Route::resource('categories', 'CategoriesController', ['except' => ['create', 'edit']]);
});
