<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('dashboard.ecommerce.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::where('status', 1)
            ->get();
        $products = Product::where('status', 1)
            ->get();
        $sizes = ProductSize::where('status', 1)
            ->get();
        $images = ProductImage::where('status', 1)
            ->get();
        return view('dashboard.ecommerce.products.create', compact('categories', 'products', 'sizes', 'images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'category_id' => 'required|exists:product_categories,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',

            ]);

            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return back();
                // return redirect()
                //     ->back()
                //     ->withErrors($validator)
                //     ->withInput(); // keeps old input values
            }

            // If passed, you can use:
            $data = $validator->validated();
            $data['sku'] = 'SKU-' . strtoupper(uniqid());
            $data['barcode'] = 'BAR-' . strtoupper(uniqid());
            $data['status'] = 1;
            Product::create($data);
            DB::commit();
            toastr()->success('Product created successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to create product.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
