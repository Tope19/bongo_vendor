<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $image->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $image->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('product-images.update', $image->id) }}" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $image->id }}">Edit Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select class="form-control" name="product_id" required>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ $image->product_id == $product->id ? 'selected' : '' }}>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <img src="{{ asset($image->image_path) }}" alt="Current Image" width="100">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Replace Image (optional)</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="is_primary" id="is_primary{{ $image->id }}" {{ $image->is_primary ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_primary{{ $image->id }}">Primary Image</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
</div>
