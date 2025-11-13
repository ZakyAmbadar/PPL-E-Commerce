<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SellerAuthController extends Controller
{
    /**
     * Menampilkan form registrasi seller
     */
    public function showRegisterForm()
    {
        return view('auth.seller-register');
    }

    /**
     * Proses registrasi seller
     */
    public function register(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string|max:500',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:sellers',
            'street_address' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:10',
            'village' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'id_card_number' => 'required|string|max:20',
            'id_card_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pic_photo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Upload files
        $idCardPath = $request->file('id_card_file')->store('seller-documents', 'public');
        $picPhotoPath = $request->file('pic_photo')->store('seller-photos', 'public');

        $seller = Seller::create([
            'store_name' => $request->store_name,
            'store_description' => $request->store_description,
            'pic_name' => $request->pic_name,
            'pic_phone' => $request->pic_phone,
            'email' => $request->email,
            'street_address' => $request->street_address,
            'rt_rw' => $request->rt_rw,
            'village' => $request->village,
            'city' => $request->city,
            'province' => $request->province,
            'id_card_number' => $request->id_card_number,
            'id_card_file' => $idCardPath,
            'pic_photo' => $picPhotoPath,
            'password' => Hash::make($request->password),
            'status' => 'pending',
        ]);

        return redirect()->route('seller.login')->with('success', 'Registrasi berhasil! Menunggu verifikasi admin.');
    }

    /**
     * Menampilkan form login seller
     */
    public function showLoginForm()
    {
        return view('auth.seller-login');
    }

    /**
     * Proses login seller
     */
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tentukan jenis login (email atau phone)
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'pic_phone';

        // Cari seller berdasarkan email/phone dan status approved
        $seller = Seller::where($loginType, $request->login)
                       ->where('status', 'approved')
                       ->first();

        // Check password dan login
        if ($seller && Hash::check($request->password, $seller->password)) {
            Auth::guard('seller')->login($seller, $request->filled('remember'));
            $request->session()->regenerate();
            
            // Redirect ke seller dashboard
            return redirect()->route('seller.dashboard');
        }

        return back()->withErrors([
            'login' => 'Kredensial tidak valid atau akun belum disetujui admin.',
        ]);
    }

    /**
     * Proses logout seller - YANG DIPERBAIKI
     */
    public function logout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect ke halaman login seller setelah logout
        return redirect()->route('seller.login');
    }


    /**
     * Menampilkan dashboard seller
     */
    public function dashboard()
    {
        return view('seller.dashboard');
    }
}