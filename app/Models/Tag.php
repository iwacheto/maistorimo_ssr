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
 * @property Vendor $vendor
 * @property ProjectGallery[] $projectGalleries
 * @property ProjectService[] $projectServices
 */
class Tag extends Model {
    /**
     * @var array
     */
//    protected $fillable = ['tag', 'project', 'created_at', 'updated_at'];
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor() {
        return $this->belongsTo('App\Models\Project', 'project');
    }

    public function projects(){
        return $this->belongsTo('App\Models\Project', 'project');
    }

    public function projectTags(){
        return $this->hasMany('App\Models\ProjectTag', 'tag_id');
    }
}
