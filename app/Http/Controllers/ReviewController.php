<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'reviewer_name' => 'required|string|max:100',
            'reviewer_email' => 'required|email|max:100',
            'reviewer_phone' => 'required|string|max:20',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $product = Product::findOrFail($productId);

        $review = new Review([
            'product_id' => $product->id,
            'reviewer_name' => $request->reviewer_name,
            'reviewer_email' => $request->reviewer_email,
            'reviewer_phone' => $request->reviewer_phone,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true // langsung approve, bisa diubah jika perlu
        ]);
        $review->save();

        // Kirim email ucapan terima kasih
        Mail::raw(
            "Terima kasih telah memberikan ulasan dan rating pada produk '" . $product->name . "'. Kami sangat menghargai masukan Anda!",
            function ($message) use ($request, $product) {
                $message->to($request->reviewer_email)
                    ->subject('Terima Kasih atas Ulasan Anda di ' . $product->name);
            }
        );

        return redirect()->route('catalog.show', $product->id)
            ->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
