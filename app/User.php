<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['id'];

    public function company()
    {
        return $this->hasOne('App\Company');
    }
}
