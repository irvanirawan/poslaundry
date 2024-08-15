<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // if user is not authenticated, redirect to login page
    if (!auth()->check()) {
        return redirect('/login');
    }
    return view('welcome');
})->middleware('auth');

// login
Route::get('/login', function () {
    return view('login');
})->name('login');

// logout
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
});

// login post
Route::post('/login', function () {
    $account = request()->input('account'); // email or username
    $password = request()->input('password');
    $remember = request()->input('remember');

    if (auth()->attempt(['email' => $account, 'password' => $password], $remember)) {
        return redirect('/');
    }

    if (auth()->attempt(['username' => $account, 'password' => $password], $remember)) {
        return redirect('/');
    }

    return redirect('/login')->withErrors(['error' => 'Invalid credentials']);
});