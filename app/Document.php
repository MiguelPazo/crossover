<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;

    public function scopeId($query, $id)
    {
        return $query->where('id', $id);
    }

    public function scopeCompanyId($query, $id)
    {
        return $query->where('company_id', $id);
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
