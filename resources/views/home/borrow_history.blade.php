<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Borrow History</title>
    @include('home.css')
</head>

<body>
    @include('home.header')

    <!-- Page Content -->
    <div class="page-heading about-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>My Borrow History</h2>
                    <span>Borrowed Items</span>
                    <a href="{{ route('history.export.pdf') }}" class="btn btn-primary">Export to PDF</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('home.message')
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Book Name</th>
                            <th>Author</th>
                            <th>Borrowed Date</th>
                            <th>Return Date</th>
                            <th>Status</th>
                            <th>Cancel Request</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrow_history as $history)
                            <tr>
                                <td>{{ $history->book->title }}</td>
                                <td>{{ $history->book->author }}</td>
                                <td>{{ $history->borrow_date }}</td>
                                <td>{{ $history->return_date }}</td>
                                <td>
                                    @switch($history->status)
                                        @case('pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @break

                                        @case('approved')
                                            <span class="badge bg-success">Approved</span>
                                        @break

                                        @case('overdue')
                                            <span class="badge bg-primary">Overdue</span>
                                        @break

                                        @case('returned')
                                            <span class="badge bg-info">Returned</span>
                                        @break

                                        @default
                                            <span class="badge bg-danger">Rejected</span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    @if ($history->status == 'pending')
                                        <form action="{{ url('cancel_borrow', $history->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('home.footer')


    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>

    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/custom.js"></script>

</body>

</html>
