<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'image_id', 'name', 'deleted'
    ];

    public function image()
    {
        return $this->belongsTo('App\Image');
    }
}
