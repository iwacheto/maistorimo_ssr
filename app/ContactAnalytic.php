<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAnalytic extends Model
{
    protected $fillable=['user_id', 'count', 'unique_count', 'type', 'date'];
}
