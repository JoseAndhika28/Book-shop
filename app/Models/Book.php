<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'stock',
        'category_id',
        'price',
        'cover_image',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
