<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class SellerAuthController extends Controller
{
    // Use config mapping instead of in-controller constant
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
        // Load mapping from config
        $provinceCities = config('locations.province_cities', []);
        $cityVillages = config('locations.city_villages', []);
        $rules = [
            'store_name' => 'required|string|max:255',
            'store_description' => 'required|string|max:500',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:sellers',
            'street_address' => 'required|string|max:255',
            'rt_rw' => 'required|string|max:10',
            'village' => 'required|string|max:255',
            'province' => ['required', 'string', Rule::in(array_keys($provinceCities))],
            'city' => ['required', 'string', Rule::in($provinceCities[$request->province] ?? [])],
            'id_card_number' => 'required|string|max:20',
            'id_card_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'pic_photo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|string|min:8|confirmed',
        ];

        // Jika untuk kota tertentu ada mapping kelurahan (dan pengguna tidak memilih manual), pastikan village masuk ke daftar mapping.
        $villageManualStatus = (int) ($request->input('village_manual', 0));
        if (isset($cityVillages[$request->city]) && !$villageManualStatus) {
            $rules['village'] = [
                'required', 'string', Rule::in($cityVillages[$request->city]),
            ];
        } else {
            // ketika manual atau tidak ada mapping, terima input string biasa
            $rules['village'] = 'required|string|max:255';
        }
        // validate village_manual as 0 or 1
        $rules['village_manual'] = 'sometimes|in:0,1';

        $messages = [
            'province.in' => 'Provinsi yang dipilih tidak valid.',
            'city.in' => 'Kota yang dipilih tidak valid untuk provinsi ini.',
            'email.unique' => 'Email sudah terdaftar sebagai penjual.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ];

        $request->validate($rules, $messages);

        // Upload files
        $idCardPath = $request->file('id_card_file')->store('seller-documents', 'public');
        $picPhotoPath = $request->file('pic_photo')->store('seller-photos', 'public');

        // Cek jika ada user dengan email yang sama
        $user = \App\Models\User::where('email', $request->email)->first();
        $seller = Seller::create([
            'user_id' => $user ? $user->id : null,
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

        // Cari user jika login pakai email
        $user = null;
        if ($loginType === 'email') {
            $user = \App\Models\User::where('email', $request->login)->first();
        }

        // Cari seller berdasarkan user_id jika user ditemukan, jika tidak fallback ke email/phone
        if ($user) {
            $seller = Seller::where('user_id', $user->id)
                           ->where('status', 'approved')
                           ->first();
        } else {
            $seller = Seller::where($loginType, $request->login)
                           ->where('status', 'approved')
                           ->first();
        }

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