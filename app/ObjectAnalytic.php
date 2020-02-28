<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectAnalytic extends Model
{
    protected $fillable=['object_id', 'user_id', 'count', 'unique_count', 'type', 'date'];

    public function object(){
        return $this->morphTo();
    }
}
