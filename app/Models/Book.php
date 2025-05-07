<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'quantity',
        'cover_image',
        'category_id',
    ];

    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
