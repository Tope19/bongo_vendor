@extends('dashboard.layouts.app', ['title' => 'View Categories'])
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">View Categories</li>
        </ol>
    </nav>

    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="row">
                    <div class="col-lg-6 mt-5 ml-3 pl-3 pb-3">
                        &nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategory">Create Category</button>

                    </div>
                </div>
                <div class="card-body">
                    {{-- <h6 class="card-title">Approved Artisans</h6> --}}

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Icon</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $cat)
                                    <tr>
                                        <td>{{ _value($cat, "id") }}</td>
                                        <td>{{ _value($cat, "name") }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ _value($cat, "icon") }}" target="_blank">
                                                View Image
                                            </a>
                                        </td>
                                        <td>{{ _value($cat, "status") }}</td>
                                        <td>{{ date('F j, Y g:i a', strtotime( _value($cat, "created_at") )) }}</td>
                                        <td>
                                            <button data-bs-toggle="modal" data-bs-target="#editCategory{{ _value($cat, "id") }}" class="btn btn-primary">Edit</button>
                                            <button data-bs-toggle="modal" data-bs-target="#deleteCategory{{ _value($cat, "id") }}" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $categories->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include("dashboard.categories.modals.create")
    @include("dashboard.categories.modals.edit")
    @include("dashboard.categories.modals.delete")
@stop
