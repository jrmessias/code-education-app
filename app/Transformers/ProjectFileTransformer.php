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

class ProjectFileTransformer extends  TransformerAbstract
{

    public function transform(ProjectFile $projectFile){
        return [
            'name' => $projectFile->name,
            'description' => $projectFile->description,
            'file_name' => $projectFile->file_name,
            'extension' => $projectFile->extension
        ];
    }
}