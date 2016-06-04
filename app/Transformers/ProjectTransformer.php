<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 28/01/2016
 * Time: 19:53
 */

namespace JrMessias\Transformers;

use JrMessias\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends  TransformerAbstract
{

    protected $defaultIncludes = ['members'];

    public function transform(Project $project){
        return [
            'id' => $project->id,
            'client_id' => $project->client_id,
            'owner' => $project->owner_id,
            'name' => $project->name,
            'description' => $project->description,
            'progress' => $project->progress,
            'status' => $project->status,
            'due_date' => $project->due_date
        ];
    }

    public function includeMembers(Project $project){
        return $this->collection($project->members, new ProjectMemberTransformer());
    }

}