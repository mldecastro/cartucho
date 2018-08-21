<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'image_id', 'url', 'size'
    ];

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function getUrl()
    {
        return asset($this->url);
    }
}
