<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// SPA Fallback - serve Vue app for all non-API routes
Route::get('/{path}', function ($path) {
    $indexPath = public_path('build/index.html');
    if (file_exists($indexPath)) {
        return response(file_get_contents($indexPath), 200)
            ->header('Content-Type', 'text/html');
    }
    return response('Vue app not built', 500);
})->where('path', '.*');