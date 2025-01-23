@php
    $menus = [
        (object) [
            "title" => "Beranda",
            "path" => "/dashboard",
            "icon" => "fas fa-home",
],
   (object) [
           "title" => "Data Jadwal",
           "path"  => "jadwals",
           "icon"  => "fas fa-calendar-alt",
],
  (object) [
         "title"  => "Data Rincian Gaji",
         "path"   => "rinciangajis",
         "icon"   => "fas fa-money-bill",
],
];
@endphp




<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Checkpoint</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
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
               @foreach ( $menus as $menu )
          <li class="nav-item">
             <a href="{{ $menu->path }}" class="nav-link {{ request()->path() === $menu->path ? 'active' : '' }}">
              <i class="nav-icon {{ $menu->icon }}"></i>
              <p>
                 {{ $menu->title }}
                <span class="right badge badge-danger"></span>
              </p>
            </a>
          </li>
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
