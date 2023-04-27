<?php

use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/fulllist', [App\Http\Controllers\HomeController::class, 'fullList']);

Route::get('/wordlist', [App\Http\Controllers\WordlistController::class, 'index'])->name('wordlist');
Route::post('/wordlist', [App\Http\Controllers\WordlistController::class, 'store'])->name('wordlist.store');
Route::put('/learned/{userlist}', [App\Http\Controllers\UserlistController::class, 'update']);
Route::get('/english', [App\Http\Controllers\HomeController::class, 'english']);
