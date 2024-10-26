<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title','author_id','description', 'photo'];

    public function author() {
        return $this->belongsTo(Author::class);
    }
    public function authorBooks()
    {
        return $this->hasMany(AuthorBook::class, 'book_id');
    }
}
