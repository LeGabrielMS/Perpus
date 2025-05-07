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
                    <h3 class="h3 display">Edit Category</h3>
                    @include('admin.message')
                </div>
            </div>
            <section class="no-padding-top no-padding-bottom">
                <div class="container-fluid">
                    <div class="div_center">

                        <form method="POST" action="{{ url('update_category', $category->id) }}">
                            @csrf
                            @method('POST')
                            <label for="category_name">Category Name:</label>
                            <input type="text" id="category_name" name="category_name"
                                value="{{ $category->cat_title }}" required>
                            <button class="btn btn-info" value="Update" type="submit">Update Category</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <!-- Page Content end-->

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
</body>

</html>
