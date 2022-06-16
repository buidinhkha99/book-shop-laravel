<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public function category()
    {
        return $this->belongsToMany(Category::class, 'group_books', 'book_id', 'category_id')->as('groupbook');
    }

}
