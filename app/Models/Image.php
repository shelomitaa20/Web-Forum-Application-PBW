<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $primaryKey = 'id_img';
    protected $fillable = ['url', 'id_post'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post', 'id_post');
    }
}
