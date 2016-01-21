<?php

namespace JrMessias\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectNote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id',
        'title',
        'note'
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
