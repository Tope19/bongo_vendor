<?php

namespace App\Http\Controllers\Vendor\Ecommerce;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        // Fetch product images with their associated products
        $productImages = ProductImage::with('product')
            ->whereHas('product', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();
        $products = Product::where('status', 1)
            ->where('user_id', $userId)
            ->get();
        return view('dashboard.ecommerce.images.index', compact('productImages', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'product_id' => 'required|exists:products,id',
                'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_primary' => 'nullable|boolean',
            ]);
            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return back();
            }

            $data = $validator->validated();
            // if is_primary is not set, set it to 0
            if (!isset($data['is_primary'])) {
                $data['is_primary'] = 0;
            }
            $data['image_path'] = $request->file('image_path')->store('product_sizes', 'public');
            // get the url of the stored icon
            $data['image_path'] = asset('storage/' . $data['image_path']);
            $data['status'] = 1;
            ProductImage::create($data);
            DB::commit();
            toastr()->success('Product Image created successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            report_error($e);
            toastr()->error('Failed to create product Image.');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_path' => 'nullable|image|max:2048',
            'is_primary' => 'nullable|boolean',
        ]);

        try {
            DB::beginTransaction();

            $productImage = ProductImage::findOrFail($id);
            $productImage->product_id = $request->product_id;
            $productImage->is_primary = $request->boolean('is_primary');

            if ($request->hasFile('image_path')) {
                // Delete old image from storage
                $oldPath = str_replace(asset('storage') . '/', '', $productImage->image_path);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                // Store new image
                $path = $request->file('image_path')->store('product_sizes', 'public');
                $productImage->image_path = asset('storage/' . $path);
            }

            $productImage->save();

            DB::commit();
            toastr()->success('Product image updated successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            report_error($e);
            toastr()->error('Failed to update product image.');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $productImage = ProductImage::find($id);
            if (!$productImage) {
                toastr()->error('Product Image not found.');
                return back();
            }

            // Convert full asset URL back to relative path for deletion
            $relativePath = str_replace(asset('storage') . '/', '', $productImage->image_path);
            // Delete the file from storage
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
            }
            $productImage->delete();
            DB::commit();
            toastr()->success('Product Image deleted successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            report_error($e);
            toastr()->error('Failed to delete product Image.');
            return back();
        }
    }
}
