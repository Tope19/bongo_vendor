@extends('dashboard.layouts.app', ['title' => 'Categories List'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories List</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-4">
                        <h4 class="card-title">Product Categories</h4>
                        <!-- Button trigger modal for category -->
                        <button type="button" class="btn btn-outline-primary mb-4" data-bs-toggle="modal"
                            data-bs-target="#categoryModal">
                            + Add Category
                        </button>
                    </div>

                    <table id="dataTableExample" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $cat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $cat->name }}</td>
                                    <td>{{ $cat->description }}</td>
                                    <td>
                                        <img src="{{ asset($cat->icon) }}" alt="{{ $cat->name }}" class="img-fluid" style="max-width: 50px;">
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $cat->status ? 'success' : 'danger' }}">
                                            {{ $cat->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>{{ $cat->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Category Modal -->
    @include('dashboard.ecommerce.categories.partials.category-modal')
@endsection
