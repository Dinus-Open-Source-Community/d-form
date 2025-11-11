<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;;
use Illuminate\Support\Str;
use Laravel\Socialite\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect ke halaman login Google
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle callback dari Google
     */
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->getId())
                       ->orWhere('email', $googleUser->getEmail())
                       ->first();

            if ($user) {
                // Update data Google jika user sudah ada
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Buat user baru jika belum ada
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => Hash::make(Str::random(16)), // Random password
                    'email_verified_at' => now(),
                ]);
            }

            // Login user
            Auth::login($user);

            return redirect()->route('admin.dashboard');
            
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Terjadi kesalahan saat login dengan Google: ' . $e->getMessage());
        }
    }
}
