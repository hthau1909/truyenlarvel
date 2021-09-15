<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
        @if(auth()->user()->can('browse home'))
        <li class="nav-item  home">
            <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Trang chủ
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          @endif
          {{-- user --}}
          @if(auth()->user()->hasRole('admin'))
          <li class="nav-item user_li">
            <a href="#" class="nav-link user">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Quản lí người dùng
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('user.index')}}" class="nav-link user-list">
                  {{-- <i class="far fa-user nav-icon"></i> --}}
                  <p>Người dùng</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('role.index')}}" class="nav-link user-role">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Vai trò</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          {{-- end --}}
          @if(auth()->user()->can('browse genre'))
          <li class="nav-item genre_li">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
                Thể loại truyện
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{route('genre.index')}}" class="nav-link genre-list">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Danh sách thể loại</p>
                </a>
              </li>
              @if(auth()->user()->can('add genre'))
               <li class="nav-item">
                <a href="{{route('genre.create')}}" class="nav-link genre-add">
                  {{-- <i class="far fa-user nav-icon"></i> --}}
                  <p>Thêm thể loại</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          @if(auth()->user()->can('browse category'))
          <li class="nav-item category_li">
            <a href="#" class="nav-link category">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Danh mục truyện
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link  category-list">
                  {{-- <i class="far fa-user nav-icon"></i> --}}
                  <p>Danh sách</p>
                </a>
              </li>
              @if(auth()->user()->can('add category'))
              <li class="nav-item">
                <a href="{{route('category.create')}}" class="nav-link category-add">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Thêm mới</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          @if(auth()->user()->can('browse post'))
          <li class="nav-item post_li">
            <a href="#" class="nav-link category">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Truyện
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('post.index')}}" class="nav-link  category-list">
                  {{-- <i class="far fa-list nav-icon"></i> --}}
                  <p>Danh sách truyện</p>
                </a>
              </li>
              @if(auth()->user()->can('add post'))
              <li class="nav-item">
                <a href="{{route('post.create')}}" class="nav-link category-add">
                  {{-- <i class="far fa-circle nav-icon"></i> --}}
                  <p>Thêm mới</p>
                </a>
              </li>
              @endif
              {{-- <li class="nav-item">
                <a href="{{route('chapter.index')}}" class="nav-link chapter-post-list">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách tất cả chương</p>
                </a>
              </li> --}}
            </ul>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link text-danger" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off"></i>
              <p>
                Đăng Xuất
              </p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
