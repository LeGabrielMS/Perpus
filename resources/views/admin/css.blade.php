<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Admin Dashboard - Sistem Informasi Perpustakaan</title>
<meta name="description" content="Admin Dashboard - Sistem Informasi Perpustakaan">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">
<meta name="author" content="Gabriel Marcellino Sinurat">

<!-- Bootstrap CSS-->
<link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">

<!-- Font Awesome CSS-->
<link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">

<!-- Custom Font Icons CSS-->
<link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">

<!-- Custom CSS -->
<style>
    .div_center {
        text-align: center;
        padding: 30px;
    }

    .categories-table {
        margin: auto;
        width: 50%;
        text-align: center;
        border: 1px solid rgb(55, 55, 55);
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
        background-color: #353535;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .categories-table th,
    .categories-table td {
        padding: 10px;
        border: 1px solid #161616;
    }

    .categories-table th {
        background-color: #fe6565;
        color: rgb(57, 57, 57);
    }

    .categories-table tr:nth-child(even) {
        background-color: #4e4e4e;
    }

    .categories-table tr:hover {
        background-color: #262626;
    }

    .categories-table th,
    .categories-table td {
        text-align: center;
        padding: 10px;
        /* Added padding for consistency */
        border: 1px solid #161616;
        /* Added border for consistency */
    }
</style>

<!-- Google fonts - Muli-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">

<!-- theme stylesheet-->
<link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">

<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="{{ asset('admin/css/custom.css') }}">

<!-- Favicon-->
<link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
