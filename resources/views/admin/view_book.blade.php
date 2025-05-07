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
                    <h3 class="h3 display"> View Books</h3>
                    @include('admin.message')
                </div>
            </div>

            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">
                        <div class="div_center">
                            <div class="col-lg-12">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Book Title</th>
                                            <th>Author Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Cover Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book as $books)
                                            <tr>
                                                <td>{{ $books->title }}</td>
                                                <td>{{ $books->author }}</td>
                                                <td>{{ $books->category->cat_title }}</td>
                                                <td>{{ $books->description }}</td>
                                                <td>{{ $books->quantity }}</td>
                                                <td><img src="{{ asset('book_cover_images/' . $books->cover_image) }}"
                                                        alt="Cover" style="width: 500px; height: auto;"></td>
                                                <td>
                                                    <a href="{{ url('edit_book', $books->id) }}"
                                                        class="btn btn-info">Edit</a>
                                                    <!-- Delete button with confirmation -->
                                                    <a href="javascript:void(0)"
                                                        onclick="confirmDelete('{{ url('delete_book', $books->id) }}')"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- Page Content end-->

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
            if (confirm('Apakah Anda yakin ingin menghapus Buku ini? Aksi ini tidak dapat diubah.')) {
                window.location.href = deleteUrl;
            }
        }
    </script>
</body>

</html>
