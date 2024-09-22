<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'post_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function video()
    {
        return $this->morphOne(Video::class, 'videoable');
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }
}
