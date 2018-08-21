<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url'
    ];

    public function file()
    {
        return $this->hasOne('App\File');
    }

    public function service()
    {
        return $this->hasOne('App\Service');
    }

    public function product()
    {
        return $this->hasOne('App\Product');
    }

    public function partner()
    {
        return $this->hasOne('App\Partner');
    }

    public function getUrl()
    {
        return asset($this->url);
    }
}
