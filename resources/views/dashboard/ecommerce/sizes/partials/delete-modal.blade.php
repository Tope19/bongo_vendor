<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteSizeModal{{ $size->id }}" tabindex="-1" aria-labelledby="deleteSizeModalLabel{{ $size->id }}">
    <div class="modal-dialog">
        <form action="{{ route('sizes.destroy', $size->id) }}" method="POST" class="modal-content">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title">Delete Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the size <strong>{{ $size->size }}</strong> for <strong>{{ $size->product->name ?? 'Product' }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>
