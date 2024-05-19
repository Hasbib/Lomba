<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $username = $request->session()->get('username');

        // Jika tidak ada username di session, arahkan ke halaman login
        if (!$username) {
            return redirect('/login')->with('error', 'Please login first.');
        }

        $user = User::where('username', $username)->first();

        // Jika user tidak ditemukan atau user tidak memiliki role yang sesuai
        if (!$user || $user->role !== $role) {
            // Update session dengan role terbaru
            $request->session()->put('role', $user->role);

            // Redirect berdasarkan role yang baru
            switch ($user->role) {
                case 'admin':
                    return redirect('/dashboard-admin')->with('error', 'Unauthorized access.');
                case 'peserta':
                    return redirect('/overview')->with('error', 'Unauthorized access.');
                case 'juri':
                    return redirect('/dashboard-juri')->with('error', 'Unauthorized access.');
                case 'petugas':
                    return redirect('/dashboard-petugas')->with('error', 'Unauthorized access.');
                default:
                    return redirect('/login')->with('error', 'Unauthorized access.');
            }
        }

        // Lanjutkan request jika role sesuai
        return $next($request);
    }
}