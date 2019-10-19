<?php

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

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/', 'HomeController@index')->name('home');

// Articles
Route::get('articles', 'ArticleController@index')->name('articles');
Route::get('articles/create', 'ArticleController@create')->name('articles.create');
Route::post('articles', 'ArticleController@store');
Route::get('articles/{article}/edit', 'ArticleController@edit')->name('articles.edit');
Route::patch('articles/{article}', 'ArticleController@update')->name('articles.update');
Route::delete('articles/{article}', 'ArticleController@destroy')->name('articles.destroy');

// Categories
Route::get('categories', 'CategoryController@index')->name('category');
Route::get('category/create', 'CategoryController@create')->name('category.create');
Route::post('category', 'CategoryController@store')->name('category.store');
Route::get('category/{category}/edit', 'CategoryController@edit')->name('category.edit');
Route::patch('category/{category}', 'CategoryController@update')->name('category.update');
Route::delete('category/{category}', 'CategoryController@destroy')->name('category.destroy');

// Ventas
Route::get('sales', 'SaleController@index')->name('sales');
Route::get('sale/create', 'SaleController@create')->name('sale.create');
Route::get('sale/findArticle', 'SaleController@findArticle');
Route::post('sales', 'SaleController@store');
Route::get('sale/ticket/{idSale}', 'SaleController@ticket')->name('ticket');
