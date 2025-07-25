<nav class="sidebar no-print">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Bongo<span> Express</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="{{ route('vendor.dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">E-commerce</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
              <i class="link-icon" data-feather="mail"></i>
              <span class="link-title">Products</span>
              <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="collapse" id="emails">
              <ul class="nav sub-menu">
                <li class="nav-item">
                  <a href="{{ route('products.index') }}" class="nav-link">Manage Products</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('sizes.index') }}" class="nav-link">Product Sizes</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('product-images.index') }}" class="nav-link">Product Images</a>
                </li>
              </ul>
            </div>
          </li>
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="link-icon" data-feather="message-square"></i>
              <span class="link-title">Orders</span>
            </a>
          </li> --}}

        </ul>
      </div>
    </nav>
