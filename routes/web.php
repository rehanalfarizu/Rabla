<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    // Serve Vue SPA from public/build folder
    $indexPath = public_path('build/index.html');
    if (file_exists($indexPath)) {
        return response(file_get_contents($indexPath), 200)
            ->header('Content-Type', 'text/html');
    }
    return response('Vue app not built', 500);
});

Route::get('/debug-session', function() {
    return response()->json([
        'session_id' => session()->getId(),
        'user' => auth()->check() ? auth()->user()->email : null,
        'is_admin' => auth()->check() ? (auth()->user()->is_admin ?? false) : null,
        'authenticated' => auth()->check(),
    ]);
});