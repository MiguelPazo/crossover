<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function stands()
    {
        return $this->hasMany('App\Stand');
    }
}
