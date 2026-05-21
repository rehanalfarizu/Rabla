<?php

use Illuminate\Support\Facades\Route;

// Serve static assets first
Route::get('/assets/{path}', function ($path) {
    $file = public_path('assets/' . $path);
    if (file_exists($file)) {
        $mime = match (pathinfo($file, PATHINFO_EXTENSION)) {
            'js' => 'application/javascript',
            'css' => 'text/css',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
            default => 'application/octet-stream'
        };
        return response(file_get_contents($file), 200)->header('Content-Type', $mime);
    }
    abort(404);
})->where('path', '.*');

// Serve Vue SPA for all other routes
Route::get('/{path}', function ($path = null) {
    $indexPath = public_path('index.html');
    if (file_exists($indexPath)) {
        return response(file_get_contents($indexPath), 200)
            ->header('Content-Type', 'text/html');
    }
    abort(404);
})->where('path', '.*');