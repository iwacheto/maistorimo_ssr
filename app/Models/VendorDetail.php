<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
class VendorDetail extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user', 'company_name', 'phone_number', 'email_address', 'contact_person', 'website', 'information', 'city_id', 'facebook_link', 'profile_image', 'main_image', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
