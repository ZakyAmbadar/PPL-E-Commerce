<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Province;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Siapkan Query Dasar (Eager Loading Seller & Review)
        // Kita perlu seller untuk filter lokasi, dan review untuk sorting rating
        $query = Product::with(['seller', 'category'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('is_active', true);

        // 2. Filter Pencarian (Nama Produk / Nama Toko)
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhereHas('seller', function($subQ) use ($request) {
                      $subQ->where('store_name', 'like', '%' . $request->search . '%');
                  });
            });
        }

        // 3. Filter Kategori
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // 4. Filter Lokasi Provinsi
        // Menggunakan whereHas untuk mengecek kolom 'province' di tabel sellers
        if ($request->province) {
            $query->whereHas('seller', function($q) use ($request) {
                $q->where('province', $request->province);
            });
        }

        // 5. Sorting/Urutkan
        if ($request->sort) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'rating_high':
                    $query->orderByDesc('reviews_avg_rating');
                    break;
                default: // 'latest'
                    $query->latest();
                    break;
            }
        } else {
            $query->latest(); // Default urutan terbaru
        }

        // Eksekusi query dengan pagination 12 item per halaman
        // withQueryString() penting agar filter tidak hilang saat pindah halaman (page 2, page 3, dst)
        $products = $query->paginate(12)->withQueryString();

        // 6. Ambil Data Master untuk Dropdown Filter di View
        $categories = Category::all();
        $provinces = Province::all(); 

        return view('catalog.index', compact('products', 'categories', 'provinces'));
    }

    public function show($id)
    {
        // Halaman Detail Produk (Persiapan)
        $product = Product::with(['seller', 'reviews.user'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->findOrFail($id);
            
        return view('catalog.detail', compact('product'));
    }
}