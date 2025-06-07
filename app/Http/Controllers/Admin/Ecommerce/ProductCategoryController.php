<?php

namespace App\Http\Controllers\Admin\Ecommerce;


use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::latest()->get();
        return view('dashboard.ecommerce.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        try{
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'icon' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
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
            // if request has an icon, store it
            if ($request->hasFile('icon')) {
                $data['icon'] = $request->file('icon')->store('product_categories', 'public');
                // get the url of the stored icon
                $data['icon'] = asset('storage/' . $data['icon']);
            }
            $data['status'] = 1;
            ProductCategory::create($data);
            DB::commit();
            toastr()->success('Product category created successfully.');
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Failed to create product category.');
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
