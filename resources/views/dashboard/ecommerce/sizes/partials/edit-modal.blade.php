<!-- Edit Size Modal -->
<div class="modal fade" id="editSizeModal{{ $size->id }}" tabindex="-1" aria-labelledby="editSizeModalLabel{{ $size->id }}">
    <div class="modal-dialog">
        <form action="{{ route('sizes.update', $size->id) }}" method="POST" class="modal-content">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Size - {{ $size->product->name ?? 'Product' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Size -->
                <div class="mb-3">
                    <label for="size{{ $size->id }}" class="form-label">Size</label>
                    <input type="text" name="size" class="form-control" id="size{{ $size->id }}" value="{{ $size->size }}" required>
                </div>
                <!-- Price -->
                <div class="mb-3">
                    <label for="price{{ $size->id }}" class="form-label">Price (₦)</label>
                    <input type="number" step="0.01" name="price" class="form-control" id="price{{ $size->id }}" value="{{ $size->price }}" required>
                </div>
                <!-- Stock -->
                <div class="mb-3">
                    <label for="stock{{ $size->id }}" class="form-label">Stock Quantity</label>
                    <input type="number" name="stock_quantity" class="form-control" id="stock{{ $size->id }}" value="{{ $size->stock_quantity }}" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
