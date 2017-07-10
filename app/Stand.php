<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    protected $guarded = ['id'];

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeEventId($query, $id)
    {
        return $query->where('event_id', $id);
    }

    public function companies()
    {
        return $this->belongsTo('App\Company');
    }
}
