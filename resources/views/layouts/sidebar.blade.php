  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('/assets/images/EL-SmartLogo_White.png') }}" alt="EL-Smart Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">EL-SMART</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-2 mb-2 d-flex align-items-center">
        <div class="image">
          <img src="{{ Auth::user()->picture }}" class="img-circle elevation-2 picture" alt="User Profile Picture">
        </div>
        <div class="info">
          <a href="{{ route('pages.user-profile') }}" class="d-block name">{{ Auth::user()->name }}</a>
          <span class="text-sm text-muted">{{ Auth::user()->role }}</span>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MAIN MENU</li>
          <li class="nav-item">
            <a href="{{ route('pages.dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pages.data-tables.index') }}" class="nav-link {{ request()->is('asset-management') || 
                                                                                request()->is('asset-management/add-new-asset') ||
                                                                                request()->is('asset-management/*/show') ||
                                                                                request()->is('asset-management/*/edit') ||
                                                                                request()->is('asset-management/recycle-bin') ||
                                                                                request()->is('asset-management/option-management') ||
                                                                                request()->is('asset-management/option-management/item/add-new-item') ||
                                                                                request()->is('asset-management/option-management/item/*/edit') ||
                                                                                request()->is('asset-management/option-management/manufacturer/add-new-manufacturer') ||
                                                                                request()->is('asset-management/option-management/manufacturer/*/edit') ||
                                                                                request()->is('asset-management/option-management/configuration-status/add-new-configuration-status') ||
                                                                                request()->is('asset-management/option-management/configuration-status/*/edit') ||
                                                                                request()->is('asset-management/option-management/location/add-new-location') ||
                                                                                request()->is('asset-management/option-management/location/*/edit') ||
                                                                                request()->is('asset-management/option-management/position-status/add-new-position-status') ||
                                                                                request()->is('asset-management/option-management/position-status/*/edit') ||
                                                                                request()->is('asset-management/filter-results/item/*') ||
                                                                                request()->is('asset-management/filter-results/manufacturer/*') ||
                                                                                request()->is('asset-management/filter-results/configuration-status/*') ||
                                                                                request()->is('asset-management/filter-results/location/*') ||
                                                                                request()->is('asset-management/filter-results/position-status/*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Asset Management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link {{ request()->is('user-manage') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->