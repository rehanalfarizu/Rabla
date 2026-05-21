<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/debug-session', function() {
    return response()->json([
        'session_id' => session()->getId(),
        'user' => auth()->check() ? auth()->user()->email : null,
        'is_admin' => auth()->check() ? (auth()->user()->is_admin ?? false) : null,
        'authenticated' => auth()->check(),
    ]);
});