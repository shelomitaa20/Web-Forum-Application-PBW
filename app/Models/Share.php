<?php
// app/Models/Share.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_share';

    protected $fillable = [
        'id_post', 'id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}