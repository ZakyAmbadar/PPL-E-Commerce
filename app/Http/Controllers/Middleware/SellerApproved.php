<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerApproved
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('seller')->check()) {
            $seller = Auth::guard('seller')->user();
            if ($seller->status !== 'approved') {
                Auth::guard('seller')->logout();
                return redirect()->route('seller.login')->withErrors([
                    'login' => 'Akun Anda belum disetujui oleh admin. Silakan tunggu verifikasi.'
                ]);
            }
        }

        return $next($request);
    }
}