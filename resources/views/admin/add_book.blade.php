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
                    <h3 class="h3 display">Tambah Buku</h3>
                    @include('admin.message')
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="row">

                        <!-- Form to add a new book -->
                        <div class="col-lg-12">
                            <form action="{{ url('store_book') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Judul Buku</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Masukkan Judul Buku" required>
                                </div>
                                <div class="form-group">
                                    <label for="author">Nama Penulis</label>
                                    <input type="text" class="form-control" id="author" name="author"
                                        placeholder="Masukkan Nama Penulis" required>
                                </div>
                                <div class="form-group">
                                    <label for="category_id">Kategori Buku</label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->cat_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Kuantitas</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        placeholder="Masukkan Kuantitas Buku" required>
                                </div>
                                <div class="form-group">
                                    <label for="cover_image">Gambar Sampul</label>
                                    <input type="file" class="form-control-file" id="cover_image" name="cover_image"
                                        accept="image/*" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi Buku</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-info">Tambah Buku</button>
                            </form>
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
