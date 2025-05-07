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

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h3 class="h3 display">Kategori</h3>
                    @include('admin.message')
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="div_center">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Form to add a new category -->
                                <form action="{{ url('add_category') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category_name">Nama Kategori:</label>
                                        <input type="text" id="category_name" name="category_name" required>
                                        <button class="btn btn-info" type="submit">Tambahkan Kategori</button>
                                    </div>
                                </form>

                                <!-- Displaying the categories in a table -->
                                <div>
                                    <table class="categories-table">
                                        <thead>
                                            <tr>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories_data as $category)
                                                <tr>
                                                    <td>{{ $category->cat_title }}</td>
                                                    <td>
                                                        <a href="{{ url('edit_category', $category->id) }}"
                                                            class="btn btn-info">Edit</a>
                                                        <!-- Delete button with confirmation -->
                                                        <a href="javascript:void(0)"
                                                            onclick="confirmDelete('{{ url('delete_category', $category->id) }}')"
                                                            class="btn btn-danger">Delete</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">Tidak ada kategori ditemukan.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End of displaying categories -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

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

    <!-- Delete confirmation script -->
    <script>
        function confirmDelete(deleteUrl) {
            if (confirm('Apakah Anda yakin ingin menghapus Kategori ini? Aksi ini tidak dapat diubah.')) {
                window.location.href = deleteUrl;
            }
        }
    </script>
</body>

</html>
