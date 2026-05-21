<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    public function sendOtp(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['Akun dengan email ini tidak ditemukan.'],
            ]);
        }

        // Generate OTP
        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Save OTP to user
        $user->update([
            'verification_token' => $otp,
            'verification_expires' => now()->addMinutes(10),
        ]);

        // Send email (in production, use proper mail service)
        // For now, log it
        \Log::info("OTP for {$user->email}: {$otp}");

        // In production, send actual email
        // Mail::raw("Your OTP code is: {$otp}", function ($message) use ($user) {
        //     $message->to($user->email)
        //             ->subject('Your OTP Code');
        // });

        return response()->json([
            'message' => 'OTP berhasil dikirim ke email.',
            'email' => $user->email,
            // For development only - remove in production
            'otp_preview' => $otp,
        ]);
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
                'email' => ['Akun tidak ditemukan.'],
            ]);
        }

        if (!$user->verification_token || $user->verification_token !== $validated['otp']) {
            throw ValidationException::withMessages([
                'otp' => ['Kode OTP tidak valid.'],
            ]);
        }

        if ($user->verification_expires && now()->isAfter($user->verification_expires)) {
            throw ValidationException::withMessages([
                'otp' => ['Kode OTP sudah kadaluarsa.'],
            ]);
        }

        // Clear OTP
        $user->update([
            'verification_token' => null,
            'verification_expires' => null,
        ]);

        // Generate new token for login
        $token = Str::random(64);
        $user->update([
            'api_token' => hash('sha256', $token),
            'last_login_at' => now(),
        ]);

        return response()->json([
            'message' => 'Login berhasil.',
            'user' => $this->sanitizeUser($user),
            'token' => $token,
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
}