<?php
/**
 * Created by PhpStorm.
 * User: Junior
 * Date: 28/01/2016
 * Time: 19:53
 */

namespace JrMessias\Transformers;

use JrMessias\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends  TransformerAbstract
{

    public function transform(ProjectNote $projectNote){
        return [
            'title' => $projectNote->title,
            'note' => $projectNote->note
        ];
    }
}