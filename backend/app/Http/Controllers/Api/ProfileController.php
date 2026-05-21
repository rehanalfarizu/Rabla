<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'user' => [
                'id' => (string) $user->_id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'avatar' => $user->avatar,
                'gender' => $user->gender,
                'birth_date' => $user->birth_date,
                'is_verified' => $user->is_verified,
            ],
            'addresses' => $user->addresses,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'gender' => 'sometimes|string|in:male,female',
            'birth_date' => 'sometimes|date',
            'address' => 'sometimes|string',
            'city' => 'sometimes|string|max:100',
            'province' => 'sometimes|string|max:100',
            'postal_code' => 'sometimes|string|max:10',
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        // Update user fields
        if (isset($validated['name'])) {
            $user->name = $validated['name'];
        }
        if (isset($validated['phone'])) {
            $user->phone = $validated['phone'];
        }
        if (isset($validated['gender'])) {
            $user->gender = $validated['gender'];
        }
        if (isset($validated['birth_date'])) {
            $user->birth_date = $validated['birth_date'];
        }

        // Update password if provided
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update or create default address
        if (isset($validated['address'])) {
            Address::updateOrCreate(
                ['user_id' => (string) $user->_id, 'is_default' => true],
                [
                    'address' => $validated['address'],
                    'city' => $validated['city'] ?? '',
                    'province' => $validated['province'] ?? '',
                    'postal_code' => $validated['postal_code'] ?? '',
                ]
            );
        }

        return response()->json([
            'message' => 'Profil berhasil diperbarui.',
            'user' => [
                'id' => (string) $user->_id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'gender' => $user->gender,
                'birth_date' => $user->birth_date,
            ],
        ]);
    }
}