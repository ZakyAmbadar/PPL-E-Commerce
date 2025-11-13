<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        $seller = Auth::guard('seller')->user();
        
        // Stats calculation
        $stats = [
            'active_products' => Product::where('seller_id', $seller->id)
                                      ->where('is_active', true)
                                      ->count(),
            'todays_orders' => 5, // Placeholder - akan diganti dengan data real dari orders table
            'average_rating' => $this->calculateAverageRating($seller->id),
        ];

        // Recent activities
        $recentActivities = $this->getRecentActivities($seller->id);

        return view('seller.dashboard', compact('stats', 'recentActivities'));
    }

    private function calculateAverageRating($sellerId)
    {
        $products = Product::where('seller_id', $sellerId)->pluck('id');
        
        if ($products->isEmpty()) {
            return 0;
        }

        $averageRating = Review::whereIn('product_id', $products)
                             ->where('is_approved', true)
                             ->avg('rating');

        return round($averageRating ?? 0, 1);
    }

    private function getRecentActivities($sellerId)
    {
        // Placeholder data - akan diganti dengan data real
        return [
            [
                'type' => 'order',
                'message' => 'New order #1234',
                'time' => '5 hours ago'
            ],
            [
                'type' => 'order', 
                'message' => 'New order #1233',
                'time' => '1 day ago'
            ],
            [
                'type' => 'review',
                'message' => 'Jane Doe: Great quality product!',
                'time' => '2 days ago'
            ],
        ];
    }
}