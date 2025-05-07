<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Categories;
use App\Models\BorrowBook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $userType = Auth::user()->usertype;

            if ($userType == 'admin') {
                $user = User::all()->count();
                $book = Book::all()->count();
                $borrow = BorrowBook::where('status', 'approved')->count();
                $returned = BorrowBook::where('status', 'returned')->count();
                return view('admin.index', compact('user', 'book', 'borrow', 'returned'));
            } elseif ($userType == 'user') {
                $book = Book::all();
                $categories = Categories::all();
                return view('home.index', compact('book', 'categories'));
            } else {
                return redirect()->back()->with('error', 'Akses tidak diizinkan');
            }
        }

        return redirect('login');
    }

    public function categories_page()
    {
        $categories_data = Categories::all();
        return view('admin.categories', compact('categories_data'));
    }

    public function add_category(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,cat_title'
        ]);

        Categories::create([
            'cat_title' => $request->category_name
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan');
    }

    public function delete_category($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Kategori berhasil dihapus');
    }

    public function edit_category($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }

    public function update_category(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,cat_title,' . $id
        ]);

        $category = Categories::findOrFail($id);
        $category->update([
            'cat_title' => $request->category_name
        ]);

        return redirect('/categories_page')->with('success', 'Kategori berhasil diperbarui');
    }

    public function add_book()
    {
        $categories = Categories::all();
        return view('admin.add_book', compact('categories'));
    }

    public function store_book(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $bookImage = $request->file('cover_image');
        $imageName = null;
        if ($bookImage) {
            $imageName = time() . '.' . $bookImage->getClientOriginalExtension();
            $bookImage->move(public_path('book_cover_images'), $imageName);
        }

        // Store book details in the database
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'cover_image' => $imageName,
        ])->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');
    }

    // Function to view all books
    public function view_book()
    {
        $book = Book::all();
        return view('admin.view_book', compact('book'));
    }

    public function delete_book($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus');
    }

    public function edit_book($id)
    {
        $book = Book::findOrFail($id);
        $categories = Categories::all();
        return view('admin.edit_book', compact('book', 'categories'));
    }

    // Function to update book details
    public function update_book(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            // Delete the old image if it exists
            if ($book->cover_image) {
                unlink(public_path('book_cover_images/' . $book->cover_image));
            }

            $bookImage = $request->file('cover_image');
            $imageName = time() . '.' . $bookImage->getClientOriginalExtension();
            $bookImage->move(public_path('book_cover_images'), $imageName);
            $book->cover_image = $imageName;
        }

        // Update book details in the database
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // Redirect back with success message
        return redirect('/view_book')->with('success', 'Buku berhasil diperbarui');
    }

    // Function to view borrow requests
    public function borrow_request()
    {
        $borrow = BorrowBook::all();
        return view('admin.borrow_request', compact('borrow'));
    }

    public function borrow_status($id, $status = null)
    {
        $borrow = BorrowBook::findOrFail($id);
        $book = Book::findOrFail($borrow->book_id);
        $oldStatus = $borrow->status;

        // If no status is provided or trying to set the same status
        if ($status === null || $oldStatus === $status) {
            $message = match ($oldStatus) {
                'approved' => 'Permintaan peminjaman sudah disetujui!',
                'rejected' => 'Permintaan peminjaman sudah ditolak!',
                'pending' => 'Permintaan peminjaman masih dalam proses!',
                'returned' => 'Buku sudah dikembalikan!',
                'overdue' => 'Permintaan peminjaman sudah jatuh tempo!',
                default => "Status peminjaman: {$oldStatus}"
            };
            return redirect()->back()->with('error', $message);
        }

        // First, handle any state where we need to restore the book quantity
        if (in_array($oldStatus, ['approved', 'overdue']) && !in_array($status, ['approved', 'overdue'])) {
            // If we're moving from a "book is out" state to any other state, increase quantity
            $book->quantity += 1;
        }

        // Then, handle the specific status transitions
        switch ($status) {
            case 'approved':
                // Allow approval from pending or if it was previously rejected
                if ($oldStatus !== 'pending' && $oldStatus !== 'rejected') {
                    return redirect()->back()->with('error', 'Hanya permintaan pending atau rejected yang dapat disetujui!');
                }

                // Only decrease quantity if we're newly approving (not transitioning between approved and overdue)
                if (!in_array($oldStatus, ['approved', 'overdue'])) {
                    // Check book availability
                    if ($book->quantity <= 0) {
                        return redirect()->back()->with('error', 'Buku tidak tersedia');
                    }

                    // Update book quantity
                    $book->quantity -= 1;

                    // Set borrow_date and return_date when approving
                    $borrow->borrow_date = now();
                    $borrow->return_date = now()->addDays(14); // 2 weeks return period
                }

                $message = 'Permintaan peminjaman disetujui';
                break;

            // Other cases remain the same...
            case 'rejected':
                if ($oldStatus !== 'pending') {
                    return redirect()->back()->with('error', 'Hanya permintaan pending yang dapat ditolak!');
                }
                // Clear any dates if there were any
                $borrow->borrow_date = null;
                $borrow->return_date = null;
                $message = 'Permintaan peminjaman ditolak';
                break;

            case 'returned':
                if ($oldStatus !== 'approved' && $oldStatus !== 'overdue') {
                    return redirect()->back()->with('error', 'Hanya buku yang dipinjam atau terlambat yang dapat dikembalikan!');
                }

                // Set actual return date
                $borrow->actual_return_date = now();
                $message = 'Buku berhasil dikembalikan';
                break;

            case 'overdue':
                if ($oldStatus !== 'approved') {
                    return redirect()->back()->with('error', 'Hanya buku yang dipinjam yang dapat diubah menjadi terlambat!');
                }
                $message = 'Status peminjaman diubah menjadi terlambat';
                break;

            case 'pending':
                if ($oldStatus !== 'rejected') {
                    return redirect()->back()->with('error', 'Hanya permintaan yang ditolak yang dapat diubah kembali menjadi pending!');
                }
                // Clear any dates if there were any
                $borrow->borrow_date = null;
                $borrow->return_date = null;
                $message = 'Status peminjaman diubah menjadi pending';
                break;

            default:
                return redirect()->back()->with('error', 'Status tidak valid');
        }

        // Update the borrow request status
        $borrow->status = $status;
        $borrow->save();
        $book->save();

        return redirect()->back()->with('success', $message);
    }
}
