<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

// Serve static assets directly - no Laravel routing for these
// Just serve index.html for root
Route::get('/', function () {
    $indexPath = public_path('index.html');
    if (File::exists($indexPath)) {
        return response(File::get($indexPath), 200)
            ->header('Content-Type', 'text/html');
    }
    abort(404);
});

// SPA fallback - serve index.html for all non-API routes
Route::get('/{any}', function ($any = null) {
    // Skip API routes
    if (str_starts_with('/' . $any, '/api/')) {
        abort(404);
    }

    $indexPath = public_path('index.html');
    if (File::exists($indexPath)) {
        return response(File::get($indexPath), 200)
            ->header('Content-Type', 'text/html');
    }
    abort(404);
})->where('any', '.*');
