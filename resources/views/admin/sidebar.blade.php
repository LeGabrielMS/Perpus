<nav id="sidebar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar"><img src="{{ asset('admin/img/avatar-admin.jpg') }}" alt="admin"
                class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h5">Gabriel Marcellino Sinurat</h1>
            <p>Network Administrator</p>
        </div>
    </div>

    <!-- Sidebar Navidation Menus--><span class="heading">Main</span>
    <ul class="list-unstyled">
        <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="{{ url('home') }}"> <i
                    class="icon-home"></i>Home </a></li>
        <li class="{{ Request::is('categories_page') ? 'active' : '' }}"><a href="{{ url('categories_page') }}"> <i
                    class="icon-grid"></i>Managemen Kategori </a></li>
        <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i
                    class="icon-windows"></i>Managemen Buku </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                <li><a href="{{ url('add_book') }}">Tambah Buku</a></li>
                <li><a href="{{ url('view_book') }}">Kelola Buku</a></li>
            </ul>
        </li>
        <li><a href="{{ url('borrow_request') }}"> <i class="icon-logout"></i>Pinjaman Buku</a></li>
    {{-- </ul><span class="heading">Extras</span>
    <ul class="list-unstyled">
        <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
        <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
        <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
    </ul> --}}
</nav>
