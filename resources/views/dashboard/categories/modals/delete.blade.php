@foreach ($categories as $cat)
    <div class="modal fade" id="deleteCategory{{ _value($cat, "id") }}" tabindex="-1" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategory">Delete Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <p>Are you sure you want to delete this category?</p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="{{ route('categories.destroy', ["category" => _value($cat, "id")]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Yes
                        </button>
                    </form>
                    {{-- <button type="submit" class="btn btn-primary">Yes</button> --}}
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
