<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/transactions', function () {
    return view('transactions');
})->name('transactions');

Route::get('/goods', function () {
    return view('goods');
})->name('goods');

Route::get('/suppliers', function () {
    return view('suppliers');
})->name('suppliers');

Route::get('/users', function () {
    return view('users');
})->name('users');

Route::get('/members', function () {
    return view('members');
})->name('members');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');



