<div class="modal fade" id="createCategory" tabindex="-1" aria-labelledby="createCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createCategoryLabel">Create Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route("categories.store") }}" enctype="multipart/form-data" method="POST">@csrf
            @include("dashboard.status.status")
            <div class="mb-3">
              <label for="category-name" class="form-label">Category Name:</label>
              <input type="text" required name="name" class="form-control" id="category-name">
            </div>
            <div class="mb-3">
              <label for="category-icon" class="form-label">Category Icon:</label>
              <input type="file" required name="icon" class="form-control" id="category-icon">
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
