<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
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

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
