@foreach ($categories as $cat)
    <div class="modal fade" id="editCategory{{ _value($cat, "id") }}" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('categories.update', ["category" => _value($cat, "id")]) }}" enctype="multipart/form-data" method="POST">
                        @method('PUT')
                        @csrf
                        @include('dashboard.status.status')
                        <div class="mb-3">
                            <label for="category-name" class="form-label">Category Name:</label>
                            <input type="text" value="{{ _value($cat, "name") }}" name="name" class="form-control" id="category-name">
                        </div>
                        <div class="mb-3">
                            <label for="category-icon" class="form-label">Category Icon:</label>
                            <input type="file" name="icon" class="form-control" id="category-icon">
                        </div>
                        <div class="mb-3">
                            <a class="btn btn-primary" href="{{ _value($cat, "icon") }}" target="_blank">
                                View Image
                            </a>
                        </div>
                        <div class="mb-3">
                            <label for="category-icon" class="form-label">Category Status:</label>
                            <select name="status" class="form-control" id="category-status">
                                <option value="Active" {{ _value($cat, "status") == "Active" ? "selected" : "" }}>Active</option>
                                <option value="Inactive" {{ _value($cat, "status") == "Inactive" ? "selected" : "" }}>Inactive</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
