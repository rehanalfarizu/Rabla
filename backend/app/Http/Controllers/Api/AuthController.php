<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        $token = Str::random(64);
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'is_verified' => false,
            'is_admin' => false,
            'api_token' => hash('sha256', $token),
            'verification_token' => $otp,
            'verification_expires' => now()->addMinutes(10),
        ]);

        // TODO: Send OTP via SMS/Email in production
        // For now, log it (remove in production!)
        \Log::info("OTP for {$user->email}: {$otp}");

        return response()->json([
            'user' => $this->sanitizeUser($user),
            'token' => $token,
            'message' => 'Registration successful. Please verify your account.',
        ], 201);
    }

    public function verifyOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string|size:6',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['User not found.'],
            ]);
        }

        if ($user->is_verified) {
            return response()->json([
                'message' => 'Account already verified.',
                'verified' => true,
            ]);
        }

        if (!$user->verification_token || $user->verification_token !== $validated['otp']) {
            throw ValidationException::withMessages([
                'otp' => ['Invalid OTP code.'],
            ]);
        }

        if ($user->verification_expires && now()->isAfter($user->verification_expires)) {
            throw ValidationException::withMessages([
                'otp' => ['OTP has expired. Please request a new one.'],
            ]);
        }

        $user->update([
            'is_verified' => true,
            'verification_token' => null,
            'verification_expires' => null,
        ]);

        return response()->json([
            'message' => 'Account verified successfully.',
            'verified' => true,
        ]);
    }

    public function resendOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['User not found.'],
            ]);
        }

        if ($user->is_verified) {
            throw ValidationException::withMessages([
                'email' => ['Account already verified.'],
            ]);
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'verification_token' => $otp,
            'verification_expires' => now()->addMinutes(10),
        ]);

        // TODO: Send OTP via SMS/Email in production
        \Log::info("New OTP for {$user->email}: {$otp}");

        return response()->json([
            'message' => 'New OTP sent successfully.',
        ]);
    }

    private function sanitizeUser($user)
    {
        return [
            'id' => (string) $user->_id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'avatar' => $user->avatar,
            'is_verified' => $user->is_verified,
        ];
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Generate new token
        $token = Str::random(64);
        $hashedToken = hash('sha256', $token);

        error_log("=== LOGIN DEBUG ===");
        error_log("Email: " . $user->email);
        error_log("Generated token: " . $token);
        error_log("Hashed token: " . $hashedToken);

        $user->update([
            'last_login_at' => now(),
            'api_token' => $hashedToken,
        ]);

        // Verify the update worked
        $user->refresh();
        error_log("After update - api_token in DB: " . ($user->api_token ?? 'NULL'));

        return response()->json([
            'user' => $this->sanitizeUser($user),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->update(['api_token' => null]);
        }

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($this->sanitizeUser($request->user()));
    }

    // Test endpoint without middleware - directly accept Authorization header
    public function userAlt(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'message' => 'No token found in Authorization header',
                'headers' => $request->headers->all(),
            ], 401);
        }

        $hashedToken = hash('sha256', $token);
        $user = User::where('api_token', $hashedToken)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'token_length' => strlen($token),
                'hashed_token' => $hashedToken,
            ], 401);
        }

        return response()->json($this->sanitizeUser($user));
    }

    public function firebaseLogin(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'firebase_uid' => 'nullable|string',
            'display_name' => 'nullable|string',
        ]);

        $idToken = $request->bearerToken();

        if (!$idToken) {
            throw ValidationException::withMessages([
                'token' => ['Token diperlukan.'],
            ]);
        }

        // Verify Firebase ID token
        try {
            $firebase = app('firebase.auth');
            $verifiedIdToken = $firebase->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->getClaim('sub');

            // Check if email matches
            $tokenEmail = $verifiedIdToken->getClaim('email');
            if ($tokenEmail !== $validated['email']) {
                throw ValidationException::withMessages([
                    'email' => ['Email tidak cocok dengan token.'],
                ]);
            }
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'token' => ['Token Firebase tidak valid.'],
            ]);
        }

        // Find or create user in database
        $user = User::where('email', $validated['email'])->first();
        $token = Str::random(64);

        if (!$user) {
            // Create new user from Firebase
            $user = User::create([
                'name' => $validated['display_name'] ?? $validated['email'],
                'email' => $validated['email'],
                'firebase_uid' => $firebaseUid,
                'is_verified' => true,
                'is_admin' => false,
                'api_token' => hash('sha256', $token),
            ]);
        } else {
            // Update existing user
            $user->update([
                'firebase_uid' => $firebaseUid ?? $user->firebase_uid,
                'last_login_at' => now(),
                'api_token' => hash('sha256', $token),
            ]);
        }

        return response()->json([
            'user' => $this->sanitizeUser($user),
            'token' => $token,
        ]);
    }

    public function firebaseRegister(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
        ]);

        $idToken = $request->bearerToken();

        if (!$idToken) {
            throw ValidationException::withMessages([
                'token' => ['Token diperlukan.'],
            ]);
        }

        // Verify Firebase ID token
        try {
            $firebase = app('firebase.auth');
            $verifiedIdToken = $firebase->verifyIdToken($idToken);
            $firebaseUid = $verifiedIdToken->getClaim('sub');

            // Check if email matches
            $tokenEmail = $verifiedIdToken->getClaim('email');
            if ($tokenEmail !== $validated['email']) {
                throw ValidationException::withMessages([
                    'email' => ['Email tidak cocok dengan token.'],
                ]);
            }
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'token' => ['Token Firebase tidak valid.'],
            ]);
        }

        // Check if user already exists
        $existingUser = User::where('email', $validated['email'])->first();
        $token = Str::random(64);

        if ($existingUser) {
            // If user exists, just login
            $existingUser->update([
                'firebase_uid' => $firebaseUid,
                'last_login_at' => now(),
                'api_token' => hash('sha256', $token),
            ]);

            return response()->json([
                'user' => $this->sanitizeUser($existingUser),
                'token' => $token,
            ]);
        }

        // Create new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'firebase_uid' => $firebaseUid,
            'is_verified' => true,
            'is_admin' => false,
            'api_token' => hash('sha256', $token),
        ]);

        return response()->json([
            'user' => $this->sanitizeUser($user),
            'token' => $token,
        ], 201);
    }
}