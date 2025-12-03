<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
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

        // Products per category (for chart)
        $categories = Category::withCount('products')->orderBy('name')->get();
        $categoryLabels = $categories->pluck('name');
        $categoryCounts = $categories->pluck('products_count');

        // Sellers per province (for chart)
        $provinceStats = Seller::select('province', DB::raw('count(*) as count'))
            ->groupBy('province')
            ->orderBy('province')
            ->get();
        $provinceLabels = $provinceStats->map(function ($r) { return $r->province ?: 'Unknown'; });
        $provinceCounts = $provinceStats->pluck('count');

        // Active vs Inactive sellers
        $activeCount = Seller::where('status', 'approved')->count();
        $inactiveCount = Seller::where('status', '!=', 'approved')->count();

        // Reviews: counts with comments and ratings
        $reviewsWithComments = Review::whereNotNull('comment')->where('comment', '<>', '')->count();
        $reviewsWithRating = Review::whereNotNull('rating')->where('rating', '>', 0)->count();

        $recentSellers = Seller::latest()->take(5)->get();
        $recentProducts = Product::with('seller', 'category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'stats', 'recentSellers', 'recentProducts',
            'categoryLabels', 'categoryCounts',
            'provinceLabels', 'provinceCounts',
            'activeCount', 'inactiveCount',
            'reviewsWithComments', 'reviewsWithRating'
        ));
    }

    /**
     * Display pending sellers for verification
     */
    public function pendingSellers()
    {
        // Gunakan manual count untuk menghindari withCount error
        $pendingSellers = Seller::where('status', 'pending')
                              ->latest()
                              ->get();

        // Hitung products_count manual
        foreach($pendingSellers as $seller) {
            $seller->products_count = Product::where('seller_id', $seller->id)->count();
        }

        $stats = [
            'pending_count' => $pendingSellers->count(),
            'approved_count' => Seller::where('status', 'approved')->count(),
            'rejected_count' => Seller::where('status', 'rejected')->count(),
            'total_sellers' => Seller::count(),
        ];

        return view('admin.seller-verification', compact('pendingSellers', 'stats'));
    }

    /**
     * Display all sellers for management
     */
    public function allSellers()
    {
        $sellers = Seller::latest()->get();

        // Hitung products_count manual
        foreach($sellers as $seller) {
            $seller->products_count = Product::where('seller_id', $seller->id)->count();
        }

        return view('admin.sellers', compact('sellers'));
    }

    /**
     * Approve a seller
     */
    public function approveSeller($id)
    {
        $seller = Seller::findOrFail($id);
        
        $seller->update([
            'status' => 'approved',
            'verified_at' => now(),
        ]);

        return redirect()->route('admin.seller.verification')
                         ->with('success', 'Seller approved successfully!');
    }

    /**
     * Reject a seller
     */
    public function rejectSeller(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $seller = Seller::findOrFail($id);
        
        $seller->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return redirect()->route('admin.seller.verification')
                         ->with('success', 'Seller rejected successfully!');
    }
}