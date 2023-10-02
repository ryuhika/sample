<?php

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
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/products', 'App\Http\Controllers\ProductController@index')->name('products.index');
Route::get('/products/create', 'App\Http\Controllers\ProductController@create')->name('product.create')->middleware('auth');
Route::post('/products/store', 'App\Http\Controllers\ProductController@store')->name('product.store')->middleware('auth');
Route::get('/products/edit/{product}', 'App\Http\Controllers\ProductController@edit')->name('product.edit')->middleware('auth');
Route::put('/products/edit/{product}', 'App\Http\Controllers\ProductController@update')->name('product.update');
Route::get('/products/show/{product}', 'App\Http\Controllers\ProductController@show')->name('product.show')->middleware('auth');
Route::delete('/products/{product}', 'App\Http\Controllers\ProductController@destroy')->name('product.destroy')->middleware('auth');
Route::get('/receives', 'App\Http\Controllers\ReceiveController@index')->name('receives.index');
Route::get('/receives/create', 'App\Http\Controllers\ReceiveController@create')->name('receive.create')->middleware('auth');
Route::post('/receives/store/', 'App\Http\Controllers\ReceiveController@store')->name('receive.store')->middleware('auth');
Route::get('/receives/edit/{receive}', 'App\Http\Controllers\ReceiveController@edit')->name('receive.edit')->middleware('auth');
Route::put('/receives/edit/{receive}', 'App\Http\Controllers\ReceiveController@update')->name('receive.update')->middleware('auth');
Route::delete('/receives/{receive}', 'App\Http\Controllers\ReceiveController@destroy')->name('receive.destroy')->middleware('auth');

