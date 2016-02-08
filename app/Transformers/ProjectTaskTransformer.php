<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 28/01/2016
 * Time: 19:53
 */

namespace JrMessias\Transformers;

use JrMessias\Entities\ProjectTask;
use League\Fractal\TransformerAbstract;

class ProjectTaskTransformer extends  TransformerAbstract
{

    public function transform(ProjectTask $projectTask){
        return [
            'name' => $projectTask->name,
            'start_date' => $projectTask->start_date,
            'due_date' => $projectTask->due_date
        ];
    }
}