<?php
use Illuminate\Support\Facades\Route;

Route::get('/debug-session', function() {
    $user = auth()->user();
    return response()->json([
        'session_id' => session()->getId(),
        'user' => $user ? $user->email : null,
        'is_admin' => $user ? ($user->is_admin ?? false) : null,
    ]);
});

Route::get('/debug-cookies', function() {
    return response()->json([
        'cookies' => request()->cookies->all(),
        'headers' => request()->headers->all(),
    ]);
});
