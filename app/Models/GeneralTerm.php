<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralTerm extends Model
{
    protected $fillable = ['vendor_id', 'name', 'address_reg', 'eik', 'manager', 'phone', 'email', 'address', 'description'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user');
    }
}
