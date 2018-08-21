<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'image_id', 'name', 'deleted'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}
