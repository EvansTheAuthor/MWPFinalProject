<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProfile;

class ProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        $user = $request->user() ?: Auth::user();
        $profile = $user->profile;

        return response()->json([
            'user' => $user,
            'profile' => $profile
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user() ?: Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $profileData = $request->only(['photo', 'phone', 'birthdate', 'gender']);
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully.'
        ]);
    }
}
