<?php

namespace JrMessias\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $fillable = [
        'id',
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date'
    ];

    public function owner()
    {
        return $this->hasOne('\JrMessias\Entities\User', 'id', 'owner_id');
    }

    public function client()
    {
        return $this->hasOne('\JrMessias\Entities\Client', 'id', 'client_id');
    }
}
