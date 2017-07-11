<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeEventId($query, $id)
    {
        return $query->where('event_id', $id);
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function event()
    {
        return $this->belongsTo('App\Event');
    }
}
