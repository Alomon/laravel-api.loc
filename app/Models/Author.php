<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['fullname'];

    public function books() {
        return $this->hasMany(Book::class);
    }
    public function authorBooks()
    {
        return $this->hasMany(AuthorBook::class, 'author_id');
    }
}
