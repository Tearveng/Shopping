<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'description', 'content', 'image', 'publish_at', 'catagory_id', 'user_id', 'album_id', 'price'
    ];

    protected $dates = [
        'publish_at'
    ];

    public function catagory()
    {
        return $this->belongsTo(Catagory::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }

    /**
     * check if post has tags
     * 
     * @return bool
     */

    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());

    }

    public function hasOption($optionId)
    {
        return in_array($optionId, $this->options->pluck('id')->toArray());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('publish_at', '<=', now());
    }

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if(!$search)
        {
            return $query->published();
        }

        return $query->published()->where('title', 'LIKE', "%{$search}%");
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    
}
