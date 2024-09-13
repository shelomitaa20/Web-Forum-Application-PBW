<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_post';

    protected $fillable = [
        'title', 'content', 'parent', 'id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'id_post', 'id_post');
    }

    public function comments()
    {
        return $this->hasMany(Post::class, 'parent', 'id_post');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'id_post', 'id_post')->distinct();
    }

    public function shares()
    {
        return $this->hasMany(Share::class, 'id_post', 'id_post')->distinct();
    }

    public function getTotalLikesAttribute()
    {
        return $this->likes()->count();
    }
}
