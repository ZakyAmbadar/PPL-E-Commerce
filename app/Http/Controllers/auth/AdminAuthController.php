<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_sellers' => Seller::count(),
            'approved_sellers' => Seller::where('status', 'approved')->count(),
            'pending_sellers' => Seller::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_reviews' => Review::count(),
        ];

        $recentSellers = Seller::latest()->take(5)->get();
        $recentProducts = Product::with('seller', 'category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentSellers', 'recentProducts'));
    }

    public function sellers()
    {
        $sellers = Seller::withCount('products')->latest()->get();
        return view('admin.sellers', compact('sellers'));
    }

    public function approveSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->update(['status' => 'approved', 'verified_at' => now()]);
        
        return redirect()->back()->with('success', 'Seller approved successfully!');
    }

    public function rejectSeller($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->update(['status' => 'rejected']);
        
        return redirect()->back()->with('success', 'Seller rejected successfully!');
    }
}