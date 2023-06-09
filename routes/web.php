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
    return view('welcome');
});

Route::get('registro', function () {
    return view('registro');
});

Route::get('users', function () {
    return view('usuarios');
});

Route::get('vista', function () {
    return view('vista');
});

Route::get('crear-post', function () {
    return view('crear-post');
});

Route::get('post/{id}', function () {
    return view('post');
});

Route::get('categorias', function () {
    return view('categoria');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

