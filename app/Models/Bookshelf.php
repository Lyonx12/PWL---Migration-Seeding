<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookshelf extends Model
{
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    protected $fillable = ['code', 'name'];
}
