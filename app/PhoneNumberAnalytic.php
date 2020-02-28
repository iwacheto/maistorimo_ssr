<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumberAnalytic extends Model
{
    protected $fillable=['object_id', 'user_id', 'count', 'object_type', 'date'];

    public function object(){
        return $this->morphTo();
    }
}
