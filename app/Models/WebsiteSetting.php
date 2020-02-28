<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $main_image
 * @property string $logo
 * @property string $home_text
 * @property string $about_us
 * @property string $color
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class WebsiteSetting extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'main_image', 'raw_data', 'home_heading', 'bullet_1_heading', 'bullet_1_content', 'bullet_2_heading', 'bullet_2_content', 'bullet_3_heading', 'bullet_3_content',
    'lat', 'lng', 'formatted_address', 'logo', 'home_text', 'about_us', 'about_us_2', 'color', 'created_at', 'updated_at' ,'seo_title','seo_description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
