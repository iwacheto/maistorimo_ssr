<?php

namespace App\Models;

use App\ObjectAnalytic;
use App\PhoneNumberAnalytic;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property ProjectService[] $projectServices
 * @property VendorService[] $vendorServices
 */
class Service extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectServices()
    {
        return $this->hasMany('App\Models\ProjectService', 'service');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vendorServices()
    {
        return $this->hasMany('App\Models\VendorService', 'service');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function projectGalleries()
    {
        return $this->hasMany('App\Models\ProjectGallery', 'project');
    }

    public function vendor() {
        return $this->belongsTo('App\Models\VendorDetail', 'user_id', 'user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeCity($query, $value) {
        return $query->with(['vendor'])->whereHas('vendor.city', function ($q) use ($value) {
            $q->where('city', 'LIKE', '%' . $value . '%');
        });
    }

    public function scopeTitle($query, $value)
    {
        return $query->where('name', 'LIKE', '%' . $value . '%');
    }

    public function scopeCategory($query, $value){
        return $query->with('category')->whereHas('category', function ($q) use ($value) {
            $q->where('title', $value );
        });
    }

    public function scopemainCategory($query, $value)
    {
        return $query->with('category')->whereHas('category', function ($q) use ($value) {
            $q->whereIn('title', $value );
        });
    }
    
    public function records(){
        return $this->morphMany(ObjectAnalytic::class, 'object');
    }
}
