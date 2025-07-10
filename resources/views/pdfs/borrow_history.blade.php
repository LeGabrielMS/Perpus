<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Borrowing History</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        .header-info {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>My Borrowing History</h1>

    <div class="header-info">
        <p><strong>User:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Export Date:</strong> {{ $date }}</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Book Name</th>
                <th>Author</th>
                <th>Borrowed Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrow_history as $history)
                <tr>
                    <td>{{ $history->book->title }}</td>
                    <td>{{ $history->book->author }}</td>
                    <td>
                        {{-- Check if the borrow date is available --}}
                        {{-- If the status is pending or rejected, show N/A --}}
                        {{-- Otherwise, format the borrow date --}}
                        @if ($history->status == 'pending' || $history->status == 'rejected')
                            N/A
                        @else
                            {{ $history->borrow_date->format('Y-m-d') }}
                        @endif
                    </td>
                    <td>{{ $history->return_date ? $history->return_date->format('Y-m-d') : 'N/A' }}</td>
                    <td>{{ ucfirst($history->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">You have no borrowing history.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
