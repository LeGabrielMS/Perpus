<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowBook extends Model
{
    protected $table = 'borrow_books';
    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'borrow_date',
        'return_date',
        'actual_return_date',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'return_date' => 'date',
        'actual_return_date' => 'date',
    ];

    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
