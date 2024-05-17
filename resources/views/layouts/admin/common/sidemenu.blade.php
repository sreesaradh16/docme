<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link d-flex">
        <img src="{{ URL::asset('images/dash-logo.png')}}" alt="Logo" class="brand-image">
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel userpanel1 mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ URL::asset('images/dummy-avatar.jpg')}}" class="img-circle elevation-2" alt="User Image">
                <!-- <span class="profile_image">Admin</span> -->
            </div>
            <div class="text-white">
                <p class="d-block m-0 text-white">Administrator</p>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="logout1">Logout</button>
                </form>
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
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>