<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PDF;
use App\Models\Product;
use Carbon\Carbon;

class SellerReportController extends Controller
{
    // SRS-MartPlace-12: Produk berdasarkan stock menurun
    public function stockReport()
    {
        $sellerId = Auth::guard('seller')->id();
        $products = Product::with(['category', 'reviews'])
            ->where('seller_id', $sellerId)
            ->orderByDesc('stock')
            ->get();
        $date = Carbon::now()->format('d-m-Y');
        $user = Auth::guard('seller')->user();
        $pdf = PDF::loadView('seller.reports.stock', compact('products', 'date', 'user'));
        return $pdf->download('laporan-produk-stock.pdf');
    }

    // SRS-MartPlace-13: Produk berdasarkan rating menurun
    public function ratingReport()
    {
        $sellerId = Auth::guard('seller')->id();
        $products = Product::with(['category', 'reviews'])
            ->where('seller_id', $sellerId)
            ->get()
            ->sortByDesc(function($product) {
                return $product->reviews->avg('rating') ?? 0;
            });
        $date = Carbon::now()->format('d-m-Y');
        $user = Auth::guard('seller')->user();
        $pdf = PDF::loadView('seller.reports.rating', compact('products', 'date', 'user'));
        return $pdf->download('laporan-produk-rating.pdf');
    }

    // SRS-MartPlace-14: Produk segera dipesan (stock < 2)
    public function reorderReport()
    {
        $sellerId = Auth::guard('seller')->id();
        $products = Product::with('category')
            ->where('seller_id', $sellerId)
            ->where('stock', '<', 2)
            ->orderBy('category_id')
            ->orderBy('name')
            ->get();
        $date = Carbon::now()->format('d-m-Y');
        $user = Auth::guard('seller')->user();
        $pdf = PDF::loadView('seller.reports.reorder', compact('products', 'date', 'user'));
        return $pdf->download('laporan-produk-segera-dipesan.pdf');
    }
}
