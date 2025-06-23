<?php

namespace App\Http\Controllers\Vendor\Ecommerce;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $sizes = ProductSize::with('product')
            ->whereHas('product', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->latest()
            ->get();
        $products = Product::where('user_id', $userId)
            ->get();
        return view('dashboard.ecommerce.sizes.index', compact('sizes', 'products'));
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
                'size' => 'required|string|max:255',
                'price' => 'required|numeric',
                'stock_quantity' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return back();
            }

            $data = $validator->validated();
            $data['status'] = 0;
            ProductSize::create($data);
            DB::commit();
            toastr()->success('Product Size created successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            report_error($e);
            toastr()->error('Failed to create product.');
            return back();
        }


    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       try{
            DB::beginTransaction();
            $productSize = ProductSize::findOrFail($id);
            if (!$productSize) {
                toastr()->error('Product Size not found.');
                return back();
            }

            $validator = Validator::make($request->all(), [
                'product_id' => 'nullable|exists:products,id',
                'size' => 'nullable|string|max:255',
                'price' => 'nullable|numeric',
                'stock_quantity' => 'nullable|numeric',
            ]);
            if ($validator->fails()) {
                toastr()->error($validator->errors()->first());
                return back();
            }

            $data = $validator->validated();
            // $data['status'] = 0;
            $productSize->update($data);
            DB::commit();
            toastr()->success('Product Size updated successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            report_error($e);
            toastr()->error('Failed to update product size.');
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
            $productSize = ProductSize::findOrFail($id);
            if (!$productSize) {
                toastr()->error('Product Size not found.');
                return back();
            }
            $productSize->delete();
            DB::commit();
            toastr()->success('Product Size deleted successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            report_error($e);
            toastr()->error('Failed to delete product size.');
            return back();
        }
    }
}
