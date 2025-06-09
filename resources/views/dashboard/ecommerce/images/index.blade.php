@extends('dashboard.layouts.app', ['title' => 'Product Images List'])

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />
<script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Media</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product Images</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

            <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <h4 class="card-title">Product Images</h4>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#imageModal">
                        + Add Product Image
                    </button>
                </div>

                <table id="dataTableExample" class="table table-striped display">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Primary</th>
                            <th>Uploaded</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($productImages as $image)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $image->product->name ?? '-' }}</td>
                                <td>
                                     <a href="{{ asset($image->image_path) }}" target="_blank" class="btn btn-sm btn-secondary">
                                        <img src="{{ asset($image->image_path) }}" alt="Product Image" width="50" height="50">
                                     </a>
                                </td>
                                <td>
                                        <span class="badge bg-{{ $image->is_primary ? 'success' : 'secondary' }}">
                                        {{ $image->is_primary ? 'Yes' : 'No' }}
                                    </span>
                                    </a>
                                </td>
                                <td>{{ $image->created_at->format('d M Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editModal{{ $image->id }}">Edit</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $image->id }}">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No images uploaded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

<!-- Product Image Modal -->
@include('dashboard.ecommerce.images.partials.image-modal')
@foreach ($productImages as $image)
        @include('dashboard.ecommerce.images.partials.edit-modal')
        @include('dashboard.ecommerce.images.partials.delete-modal')
    @endforeach
@endsection
