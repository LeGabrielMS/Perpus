<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Categories;
use App\Models\BorrowBook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class HomeController extends Controller
{
    public function index()
    {
        $book = Book::all();
        $categories = Categories::all();
        return view('home.index', compact('book', 'categories'));
    }

    public function book_details($id)
    {
        $book = Book::find($id);
        return view('home.book_details', compact('book'));
    }

    public function borrow_books($book_id)
    {
        // First, check if the user is authenticated
        if (!auth()->check()) {
            return redirect('login')->with('error', 'Anda harus login untuk meminjam buku');
        }

        $user_id = auth()->user()->id;
        $book = Book::findOrFail($book_id);

        // Check if the user already has an active borrow request for this book
        $activeRequest = BorrowBook::where('user_id', $user_id)
            ->where('book_id', $book_id)
            ->whereIn('status', ['pending', 'approved', 'overdue'])
            ->first();

        // Only prevent borrowing if there's an active request
        if ($activeRequest) {
            if ($activeRequest->status == 'pending') {
                return redirect()->back()->with('error', 'Anda sudah memiliki permintaan peminjaman yang menunggu persetujuan untuk buku ini');
            } elseif ($activeRequest->status == 'approved' || $activeRequest->status == 'overdue') {
                return redirect()->back()->with('error', 'Anda masih meminjam buku ini. Silakan kembalikan terlebih dahulu');
            }
        }

        // Check if book is available
        if ($book->quantity <= 0) {
            return redirect()->back()->with('error', 'Maaf, buku tidak tersedia saat ini');
        }

        // Create new borrow request
        $borrow = new BorrowBook();
        $borrow->user_id = $user_id;
        $borrow->book_id = $book_id;
        $borrow->status = 'pending';
        // Don't set borrow_date or return_date yet!
        $borrow->save();

        return redirect()->back()->with('success', 'Permintaan peminjaman buku berhasil dikirim. Menunggu persetujuan.');
    }

    public function borrow_history()
    {
        $user_id = Auth::id();
        $borrow_history = BorrowBook::where('user_id', $user_id)->get();
        return view('home.borrow_history', compact('borrow_history'));
    }

    public function cancel_borrow($id)
    {
        $borrow_history = BorrowBook::find($id);
        if ($borrow_history) {
            $borrow_history->delete();
            return redirect()->back()->with('success', 'Permintaan peminjaman dibatalkan');
        } else {
            return redirect()->back()->with('error', 'Permintaan peminjaman tidak ditemukan');
        }
    }

    public function export_pdf()
    {
        // 1. Get the authenticated user object
        $user = Auth::user();

        // 2. Fetch the user's borrow history with eager loading for efficiency
        $borrow_history = BorrowBook::where('user_id', $user->id)
            ->with('book') // Eager load book data
            ->get();

        // 3. Prepare the data to be passed to the PDF view
        $data = [
            'user' => $user,
            'borrow_history' => $borrow_history,
            'date' => date('F j, Y') // Today's date for the header
        ];

        // 4. Load the view and generate the PDF
        $pdf = PDF::loadView('pdfs.borrow_history', $data);

        // 5. Force a download prompt for the user
        // The filename will be something like "borrowing-history-JohnDoe.pdf"
        return $pdf->download('borrowing-history-' . $user->name . '-' . now()->format('Y-m-d_H-i-s') . '.pdf');
    }

    public function explore()
    {
        $book = Book::all();
        $categories = Categories::all();
        return view('home.explore', compact('book', 'categories'));
    }
}
