<?php

namespace JrMessias\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'file_name',
        'extension'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
