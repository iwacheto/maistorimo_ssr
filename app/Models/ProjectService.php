<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $service
 * @property int $project
 * @property string $created_at
 * @property string $updated_at
 * @property Project $project
 * @property Service $service
 */
class ProjectService extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['service', 'project', 'created_at', 'updated_at'];

    protected $appends = ['serviceName'];

    public function getserviceNameAttribute()
    {
        return $this->service()->first()->name;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sProject()
    {
        return $this->belongsTo('App\Models\Project', 'project');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function service()
    {
        return $this->belongsTo('App\Models\Service', 'service');
    }

}
