<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seller = Auth::guard('seller')->user();
        
        // Debug lebih jelas
        logger('=== PRODUCT INDEX DEBUG ===');
        logger('Seller ID: ' . $seller->id);
        logger('Seller Store: ' . $seller->store_name);
        
        $products = Product::with('category')
                          ->where('seller_id', $seller->id)
                          ->latest()
                          ->get();
        
        logger('Products found: ' . $products->count());
        foreach($products as $product) {
            logger('Product: ' . $product->name . ' | ID: ' . $product->id);
        }
        logger('=== END DEBUG ===');
        
        return view('seller.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        logger('Categories count: ' . $categories->count());
        return view('seller.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|in:new,used',
            'min_order' => 'required|integer|min:1',
        ]);

        $seller = Auth::guard('seller')->user();

        logger('=== PRODUCT STORE DEBUG ===');
        logger('Seller: ' . $seller->store_name . ' (ID: ' . $seller->id . ')');
        logger('Product Data: ' . json_encode($request->all()));
        
        try {
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'weight' => $request->weight,
                'category_id' => $request->category_id,
                'seller_id' => $seller->id,
                'condition' => $request->condition,
                'min_order' => $request->min_order,
                'is_active' => true,
            ]);

            logger('Product created successfully: ' . $product->id);
            logger('=== END DEBUG ===');
            
            return redirect()->route('seller.products.index')
                             ->with('success', 'Product created successfully!');
                             
        } catch (\Exception $e) {
            logger('ERROR creating product: ' . $e->getMessage());
            return back()->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // Verify product belongs to current seller
        if ($product->seller_id !== Auth::guard('seller')->user()->id) {
            abort(403);
        }

        return view('seller.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Verify product belongs to current seller
        if ($product->seller_id !== Auth::guard('seller')->user()->id) {
            abort(403);
        }

        $categories = Category::all();
        return view('seller.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Verify product belongs to current seller
        if ($product->seller_id !== Auth::guard('seller')->user()->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|in:new,used',
            'min_order' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'category_id' => $request->category_id,
            'condition' => $request->condition,
            'min_order' => $request->min_order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Verify product belongs to current seller
        if ($product->seller_id !== Auth::guard('seller')->user()->id) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
                         ->with('success', 'Product deleted successfully!');
    }

    /**
     * Toggle product status (active/inactive)
     */
    public function toggleStatus(Product $product)
    {
        if ($product->seller_id !== Auth::guard('seller')->user()->id) {
            abort(403);
        }

        $product->update([
            'is_active' => !$product->is_active
        ]);

        return redirect()->back()->with('success', 'Product status updated!');
    }
}