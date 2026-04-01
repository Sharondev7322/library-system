<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'pengarang', 'isbn', 'category_id', 'stok', 'cover_image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function getAvailableStockAttribute()
    {
        $borrowed = $this->borrowings()->where('status', 'dipinjam')->count();
        return $this->stok - $borrowed;
    }
}
