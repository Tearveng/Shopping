<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['image', 'album_code'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
