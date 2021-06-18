<?php

namespace App\Models;

use App\ObjectAnalytic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $vendor
 * @property int $category
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property ProjectGallery[] $projectGalleries
 * @property ProjectService[] $projectServices
 */
class Project extends Model
{
    use SoftDeletes;

    protected $table = 'projects';
    /**
     * @var array
     */
//    protected $fillable = [
    //        'title',
    //        'short_description',
    //        'vendor',
    //        'category',
    //        'description',
    //        'created_at',
    //        'updated_at'
    //    ];
    protected $guarded = ['id'];

    protected $append = ["ProjectMainImage"];

    public function getProjectMainImageAttribute()
    {
        return $this->projectGalleries()->where('main', 1)->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor');
    }

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    //  */
    // public function service() {
    //     return $this->belongsTo('App\Models\Service', 'service_id');
    // }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectGalleries()
    {
        return $this->hasMany('App\Models\ProjectGallery', 'project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags()
    {
        return $this->hasMany('App\Models\ProjectTag', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectServices()
    {
        return $this->hasMany('App\Models\ProjectService', 'project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function scopeTitle($query, $value)
    {
        return $query->where('title', 'LIKE', '%' . $value . '%');
    }

    public function scopeTags($query, $value)
    {
        // return $query->with(['tags'])->whereHas('tags', function ($q) use ($value) {
        //     $q->whereIn('tag_id', $value);
        // });
        return $query->with(['tags'])->whereHas('tags.tag', function ($q) use ($value) {
            $q->whereIn('tag', $value);
        });
    }

    public function scopeCity($query, $value)
    {
        return $query->with('city')->whereHas('city', function ($q) use ($value) {
            $q->where('city', 'LIKE', '%' . $value . '%');
        });
    }

    public function scopeCategory($query, $value)
    {
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

    public function getRawDataAttribute($value)
    {
        return json_decode($value, true);
    }

    public function records()
    {
        return $this->morphMany(ObjectAnalytic::class, 'object');
    }
}
