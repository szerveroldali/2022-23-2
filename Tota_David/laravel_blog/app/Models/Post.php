<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'author_id'];

    public function author() {
        // The author_id column is the foreign key, by default
        // Laravel will look for a column named user_id
        return $this->belongsTo(User::class, 'author_id');
    }

    public function categories() {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}
