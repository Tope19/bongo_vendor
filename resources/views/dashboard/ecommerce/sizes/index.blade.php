@extends('dashboard.layouts.app', ['title' => 'Product Sizes List'])
@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Sizes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Sizes</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <h4 class="card-title">Product Sizes</h4>
                        <!-- Button trigger modal for size -->
                        <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal"
                            data-bs-target="#sizeModal">
                            + Add Size
                        </button>
                    </div>

                    <table id="dataTableExample" class="table table-striped display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sizes as $size)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $size->product->name ?? '-' }}</td>
                                    <td>{{ $size->size }}</td>
                                    <td>₦{{ number_format($size->price, 2) }}</td>
                                    <td>{{ $size->stock_quantity }}</td>
                                    <td>
                                        <span class="badge bg-{{ $size->status ? 'success' : 'danger' }}">
                                            {{ $size->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $size->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No sizes found.</td>
                                </tr>
                            @endforelse
                            {{-- {{ $sizes->links() }} --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Size Modal -->
    @include('dashboard.ecommerce.sizes.partials.size-modal')

@endsection
