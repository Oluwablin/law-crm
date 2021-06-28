<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\UsersSeeder;
use App\Http\Controllers;

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
    return view('welcome');
});

/** Cache */
Route::get('/clear-cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

/** SEED DB */
Route::get('/seed-db', function() {
    UsersSeeder::corps();
    return "Database seeded successfully";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Logged Users Only

Route::group(['middleware' => 'auth', 'namespace' => 'App\Http\Controllers'],function () {

    //CLIENTS
    Route::get('client_index',      'ClientController@index')->name('client_index');
    Route::get('client_create',      'ClientController@create')->name('client_create');
    Route::post('store_client',     'ClientController@store')->name('store_client');
    Route::get('client_view/{id}',     'ClientController@show')->name('client_view');
    Route::get('client_edit/{id}',     'ClientController@edit')->name('client_edit');
    Route::patch('client_update/{id}',     'ClientController@updateProfile')->name('client_update');
    Route::delete('client/{id}',          'ClientController@destroy')->name('client_delete');
});

require __DIR__.'/auth.php';
