<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('product-images.store') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Add Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Select Product</label>
                    <select class="form-select" name="product_id" required>
                        <option value="">Choose product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" class="form-control" name="image_path" required>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="is_primary" value="1" class="form-check-input" id="isPrimary">
                    <label class="form-check-label" for="isPrimary">Primary Image</label>
                </div>
            </div>

            <div class="modal-footer">
                <input type="submit" value="Upload Image" class="btn btn-info">
            </div>
        </form>
    </div>
</div>
