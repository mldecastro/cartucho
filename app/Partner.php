<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'image_id', 'name', 'link', 'deleted'
    ];

    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}
