<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['title', 'image', 'qty', 'option', 'price', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
