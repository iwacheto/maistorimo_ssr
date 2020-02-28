<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $project
 * @property boolean $main
 * @property string $url
 * @property string $thumb
 * @property string $created_at
 * @property string $updated_at
 */
class ProjectGallery extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_gallery';

    /**
     * @var array
     */
    protected $fillable = ['project', 'main', 'url', 'thumb', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project');
    }
}
