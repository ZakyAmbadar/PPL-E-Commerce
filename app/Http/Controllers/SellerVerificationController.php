<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class SellerVerificationController extends Controller
{
    /**
     * Display pending sellers for verification
     */
    public function pendingSellers()
    {
        $pendingSellers = Seller::where('status', 'pending')
                              ->withCount('products')
                              ->latest()
                              ->get();

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
        $sellers = Seller::withCount('products')
                        ->latest()
                        ->get();

        return view('admin.sellers', compact('sellers'));
    }

    /**
     * Show seller details for verification
     */
    public function showSeller($id)
    {
        $seller = Seller::findOrFail($id);
        
        return view('admin.seller-detail', compact('seller'));
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