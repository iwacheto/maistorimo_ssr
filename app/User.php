<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projects() {
        return $this->hasMany('App\Models\Project', 'user');
    }

    public function vendorDetails() {
        return $this->hasOne('App\Models\VendorDetail', 'user');
    }

    public function city() {
        return $this->belongsTo('App\Models\City', 'city_id');
    }

    public function terms() {
        return $this->hasOne('App\Models\GeneralTerm', 'vendor_id');
    }

    public function websiteSettings() {
        return $this->hasOne('App\Models\WebsiteSetting', 'user_id');
    }

    public function articles() {
        return $this->hasMany('App\Models\BlogArticle');
    }

    public function services() {
        return $this->hasMany('App\Models\Service');
    }


}
