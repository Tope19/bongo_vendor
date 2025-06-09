<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $image->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $image->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('product-images.destroy', $image->id) }}" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel{{ $image->id }}">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this image for <strong>{{ $image->product->name }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
