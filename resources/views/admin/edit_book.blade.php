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

        <!-- Page Content--->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h3 class="h3 display">Edit Buku</h3>
                    @include('admin.message')
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="div_center">
                        <div class="col-lg-12">
                            <div class="row">
                                <form action="{{ url('update_book', $book->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Judul Buku:</label>
                                        <input type="text" id="title" name="title" class="form-control"
                                            value="{{ $book->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="author">Nama Penulis:</label>
                                        <input type="text" id="author" name="author" class="form-control"
                                            value="{{ $book->author }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Kategori Buku</label>
                                        <select id="category_id" name="category_id" class="form-control" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $book->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->cat_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Deskripsi:</label>
                                        <textarea id="description" name="description" class="form-control" required>{{ $book->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Kuantitas:</label>
                                        <input type="number" id="quantity" name="quantity" class="form-control"
                                            value="{{ $book->quantity }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="cover_image">Gambar Sampul:</label>
                                        <input type="file" id="cover_image" name="cover_image"
                                            class="form-control-file" accept="image/*">
                                        <img src="{{ asset('book_cover_images/' . $book->cover_image) }}" alt="Cover"
                                            style="width: 100px; height: auto;">
                                    </div>
                                    <button type="submit" class="btn btn-info">Update Buku</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- Page Content end-->

        <!-- Page Footer-->
        @include('admin.footer')
        <!-- Page Footer end-->
    </div>

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
