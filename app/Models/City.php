<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {
    protected $table = 'cities';

    protected $guarded = ['id'];
    protected $hidden = ["created_at", "updated_at"];

    public function projects() {
        return $this->hasMany('App\Models\Project');
    }
    public function vendors(){
        return $this->hasMany(VendorDetail::class);
    }
    public function scopeName($query, $value) {
        return $query->where('city', 'LIKE', '%' . $value . '%');
//        return $query->with('category')->whereHas('category', function ($q) use ($value) {
//
//
//            $q->where('id', $value);
//        });
    }
}
