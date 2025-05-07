<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
        <!-- Sidebar Navigation-->
        @include('admin.sidebar')
        <!-- Sidebar Navigation end-->

        <!-- Page Content-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h3 class="h3 display">Pinjaman Buku</h3>
                    @include('admin.message')
                </div>
            </div>
            <section class="no-padding-top">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <table class="table table-striped table-bordered" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Nomor Telepon</th>
                                                <th>Judul Buku</th>
                                                <th>Kuantitas</th>
                                                <th>Sampul Buku</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($borrow as $request)
                                                <tr>
                                                    <td>{{ $request->user->name }}</td>
                                                    <td>{{ $request->user->email }}</td>
                                                    <td>{{ $request->user->phone }}</td>

                                                    <td>{{ $request->book->title }}</td>
                                                    <td>{{ $request->book->quantity }}</td>
                                                    <td>
                                                        <img src="{{ asset('book_cover_images/' . $request->book->cover_image) }}"
                                                            alt="Book Cover" width="150">
                                                    </td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn dropdown-toggle p-0" type="button"
                                                                id="statusDropdown{{ $request->id }}"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                @switch($request->status)
                                                                    @case('pending')
                                                                        <span class="badge badge-warning">Pending</span>
                                                                    @break

                                                                    @case('approved')
                                                                        <span class="badge badge-success">Approved</span>
                                                                    @break

                                                                    @case('overdue')
                                                                        <span class="badge badge-primary">Overdue</span>
                                                                    @break

                                                                    @case('returned')
                                                                        <span class="badge badge-info">Returned</span>
                                                                    @break

                                                                    @default
                                                                        <span class="badge badge-danger">Rejected</span>
                                                                @endswitch
                                                            </button>

                                                            <div class="dropdown-menu"
                                                                aria-labelledby="statusDropdown{{ $request->id }}">
                                                                <a href="{{ url('borrow_status', [$request->id, 'pending']) }}"
                                                                    class="dropdown-item">
                                                                    <span class="badge badge-warning">Pending</span>
                                                                </a>
                                                                <a href="{{ url('borrow_status', [$request->id, 'approved']) }}"
                                                                    class="dropdown-item">
                                                                    <span class="badge badge-success">Approved</span>
                                                                </a>
                                                                <a href="{{ url('borrow_status', [$request->id, 'rejected']) }}"
                                                                    class="dropdown-item">
                                                                    <span class="badge badge-danger">Rejected</span>
                                                                </a>
                                                                <a href="{{ url('borrow_status', [$request->id, 'overdue']) }}"
                                                                    class="dropdown-item">
                                                                    <span class="badge badge-primary">Overdue</span>
                                                                </a>
                                                                <a href="{{ url('borrow_status', [$request->id, 'returned']) }}"
                                                                    class="dropdown-item">
                                                                    <span class="badge badge-info">Returned</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Page Content end-->

    <!-- Page Footer-->
    @include('admin.footer')
    <!-- Page Footer end-->

    <!-- JavaScript files-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/js/charts-home.js') }}"></script>
    <script src="{{ asset('admin/js/front.js') }}"></script>
</body>

</html>
