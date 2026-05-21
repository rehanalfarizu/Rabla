<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class AuthenticateApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'Unauthenticated. Token required.',
            ], 401);
        }

        // Check if it's a Firebase token (starts with 'firebase_')
        if (str_starts_with($token, 'firebase_')) {
            // For Firebase users, just set the user from email or allow access
            // This is a simplified auth for Firebase-only users
            $firebaseUid = substr($token, 9); // Remove 'firebase_' prefix
            $user = User::where('firebase_uid', $firebaseUid)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'Unauthenticated. Firebase user not found.',
                ], 401);
            }

            $request->setUserResolver(function () use ($user) {
                return $user;
            });

            return $next($request);
        }

        // Regular token authentication
        $hashedToken = hash('sha256', $token);
        $user = User::where('api_token', $hashedToken)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Unauthenticated. Invalid token.',
            ], 401);
        }

        // Set the authenticated user
        $request->setUserResolver(function () use ($user) {
            return $user;
        });

        return $next($request);
    }
}