<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Generate PDF: Sellers by status (active first)
     */
    public function sellersByStatusPdf(Request $request)
    {
        $sellers = Seller::orderByRaw("CASE WHEN status = 'approved' THEN 0 ELSE 1 END, store_name ASC")->get();

        $data = [
            'sellers' => $sellers,
            'generated_at' => now(),
            'generated_by' => Auth::user()?->name ?? 'System'
        ];

        $pdf = Pdf::loadView('admin.reports.sellers_by_status', $data)->setPaper('a4', 'portrait');

        return $pdf->download('sellers_by_status_' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Show reports index where admin can choose which report to download
     */
    public function index(Request $request)
    {
        return view('admin.reports.index');
    }

    /**
     * Generate PDF: Sellers by province
     */
    public function sellersByProvincePdf(Request $request)
    {
        $sellers = Seller::orderBy('province', 'asc')->orderBy('store_name', 'asc')->get();

        $data = [
            'sellers' => $sellers,
            'generated_at' => now(),
            'generated_by' => Auth::user()?->name ?? 'System'
        ];

        $pdf = Pdf::loadView('admin.reports.sellers_by_province', $data)->setPaper('a4', 'portrait');

        return $pdf->download('sellers_by_province_' . now()->format('Ymd_His') . '.pdf');
    }

    /**
     * Generate PDF: Products by rating (descending)
     * Note: Review model does not store reviewer province in current schema.
     * As a pragmatic choice we include the seller's province in the report.
     */
    public function productsByRatingPdf(Request $request)
    {
        $products = Product::with('category', 'seller')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->get();

        $data = [
            'products' => $products,
            'generated_at' => now(),
            'generated_by' => Auth::user()?->name ?? 'System'
        ];

        $pdf = Pdf::loadView('admin.reports.products_by_rating', $data)->setPaper('a4', 'portrait');

        return $pdf->download('products_by_rating_' . now()->format('Ymd_His') . '.pdf');
    }
}
