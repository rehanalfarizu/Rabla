<?php

use Illuminate\Support\Facades\Route;

// Static files are served by Apache/nginx directly
Route::get('/', function () {
    return response()->file(public_path('index.html'));
});

Route::get('/debug-session', function() {
    return response()->json([
        'session_id' => session()->getId(),
        'user' => auth()->check() ? auth()->user()->email : null,
        'is_admin' => auth()->check() ? (auth()->user()->is_admin ?? false) : null,
        'authenticated' => auth()->check(),
    ]);
});
