@extends('dashboard.layouts.app', ['title' => 'Products List'])
@section('content')
<nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products List</li>
        </ol>
    </nav>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="card-title mb-0">Product List</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
                </div>

                <div class="table-responsive">
                    <table id="dataTableExample" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Barcode</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category->name ?? '-' }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->sku ?? '-' }}</td>
                                    <td>{{ $product->barcode ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->status ? 'success' : 'secondary' }}">
                                            {{ $product->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                {{-- ✅ Render pagination once below the table --}}
                {{-- <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection
